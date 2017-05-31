<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Report;
use AppBundle\Form\ReportType;
use AppBundle\Utils\CalculateReport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class DriverController
 * @package AppBundle\Controller
 *
 * @Security("has_role('ROLE_USER')")
 * @Route("/user")
 */
class DriverController extends Controller
{
    /**
     * @Route("/", name="user")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('user/userIndex.html.twig');
    }

    /**
     * @Route("/select_vehicle", name="vehicle_select")
     * @Method("GET")
     */
    public function selectAction(Request $request)
    {
        $vehicles = $this->getDoctrine()
            ->getRepository('AppBundle:Vehicle')
            ->findAll();
        return $this->render('user/vehicles.html.twig', array(
            'vehicles' => $vehicles
        ));
    }

    /**
     * @Route("/add_trip/{id}", name="add_trip")
     * @Method({"GET", "POST"})
     */
    public function tripAction($id, Request $request)
    {
        $report= new Report();

        $vehicle = $this->getDoctrine()
            ->getRepository('AppBundle:Vehicle')
            ->find($id);

        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);

        $validator = $this->get('validator');
        $errors = $validator->validate($report);

        if($form->isSubmitted() && $form->isValid())
        {
            $report->setUser($this->getUser());
            $report->setVehicle($vehicle);
            $distance = $this->get("calculations")->calculateKm($form);
            $report->setDistance($distance);
            $fuel = $this->get("calculations")->calculateFuel($form, $vehicle);
            $report->setFuel($fuel);
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            return $this->redirectToRoute('user');
        }

        return $this->render('user/editTrip.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }
}
