<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Form\ReportFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class ReportController
 * @package AppBundle\Controller
 *
 * @Security("has_role('ROLE_ADMIN')")
 * @Route("admin")
 */
class ReportController extends Controller
{
    /**
     * @Route("/reports", name="reports")
     * @Method({"GET", "POST"})
     */
    public function reportListAction(Request $request)
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->createQueryBuilder('p')
            ->where('p.role = :role')
            ->setParameter('role', 'ROLE_USER')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
        $form = $this->createForm(ReportFormType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form['user']->getData();
            $month = $form['month']->getData();
            return $this->redirectToRoute('list_reports', ['user' => $user, 'month' => $month]);
        }
        return $this->render('admin/report_form.html.twig', array(
            'users' => $users,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/reports/{user}+{month}", name="list_reports")
     * @Method("GET")
     */
    public function selectAction($user, $month)
    {
        $parameters = array(
            'user' => $user,
            'month' => $month,
            'year' => date("Y")
        );
        $reports = $this->getDoctrine()
            ->getRepository('AppBundle:Report')
            ->createQueryBuilder('p')
            ->where('p.user = :user AND MONTH(p.date) = :month AND YEAR(p.date) = :year')
            ->setParameters($parameters)
            ->orderBy('p.date', 'ASC')
            ->getQuery()
            ->getResult();
        return $this->render('admin/report.html.twig', array(
            'reports' => $reports
        ));
    }
}
