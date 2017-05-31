<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class UserController
 * @package AppBundle\Controller
 *
 * @Security("has_role('ROLE_ADMIN')")
 * @Route("/admin")
 */
class UserController extends Controller
{
    /**
     * @Route("/users", name="users")
     * @Method("GET")
     */
    public function listAction()
    {
        $users = $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();
        return $this->render('admin/users.html.twig', array(
            'users' => $users
        ));
    }
    /**
     * @Route("/new_user", name="user_create")
     * @Method({"POST", "GET"})
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('users');
        }

        return $this->render('admin/editUser.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/edit_user/{id}", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id, Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($id);

        $user->setName($user->getName());
        $user->setEmail($user->getEmail());
        $user->setRole($user->getRole());

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('users');
        }

        return $this->render('admin/editUser.html.twig', array(
            'user' => $user,
            'form' => $form->createView()
        ));
    }
    /**
     * @Route("/delete_user/{id}", name="user_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user= $em->getRepository('AppBundle:User')->find($id);

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('users');
    }
}
