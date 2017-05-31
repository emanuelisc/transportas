<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Vehicle;
use AppBundle\Form\VehicleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class VehicleController
 * @package AppBundle\Controller
 *
 * @Security("has_role('ROLE_ADMIN')")
 * @Route("/admin")
 */
class VehicleController extends Controller
{
    /**
     * @Route("/vehicles", name="vehicles")
     * @Method("GET")
     */
    public function listAction()
    {
        $vehicles = $this->getDoctrine()
            ->getRepository('AppBundle:Vehicle')
            ->findAll();
        return $this->render('admin/vehicles.html.twig', array(
            'vehicles' => $vehicles
        ));
    }
    /**
     * @Route("/new_vehicle", name="vehicle_create")
     * @Method({"GET"})
     */
    public function createAction(Request $request)
    {
        $vehicle = new Vehicle();

        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        $validator = $this->get('validator');
        $errors = $validator->validate($vehicle);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($vehicle);
            $em->flush();

            return $this->redirectToRoute('vehicles');
        }

        return $this->render('admin/editVehicle.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));

    }
    /**
     * @Route("/edit_vehicle/{id}", name="vehicle_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id, Request $request)
    {
        $vehicle= $this->getDoctrine()
            ->getRepository('AppBundle:Vehicle')
            ->find($id);

        $vehicle->setName($vehicle->getName());
        $vehicle->setStand($vehicle->getStand());
        $vehicle->setDrive($vehicle->getDrive());
        $vehicle->setUnload($vehicle->getUnload());

        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            return $this->redirectToRoute('vehicles');
        }

        return $this->render('admin/editVehicle.html.twig', array(
            'vehicle' => $vehicle,
            'form' => $form->createView()
        ));
    }
    /**
     * @Route("/delete_vehicle/{id}", name="vehicle_delete")
     * @Method({"GET"})
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $vehicle= $em->getRepository('AppBundle:Vehicle')->find($id);

        $em->remove($vehicle);
        $em->flush();

        return $this->redirectToRoute('vehicles');
    }
}
