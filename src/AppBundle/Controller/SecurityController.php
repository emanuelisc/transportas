<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;
use AppBundle\Form\RegisterType;

class SecurityController extends Controller
{
    /**
     * @Route("/", name="login")
     * @Method({"GET"})
     */
    public function loginAction(Request $request)
    {
        $helper = $this->get('security.authentication_utils');

        return $this->render(
            'auth/login.html.twig',
            array(
                'last_username' => $helper->getLastUsername(),
                'error'         => $helper->getLastAuthenticationError(),
            )
        );
    }

    /**
     * @Route("/login_check", name="security_login_check")
     * @Method({"POST"})
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route("/logout", name="logout")
     * @Method({"GET"})
     */
    public function logoutAction()
    {

    }

    /**
     * @Route("/register", name="register")
     * @Method({"GET", "POST"})
     */
    public function registerAction(Request $request)
    {
        // Create a new blank user and process the form
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // Set their role
            $user->setRole('ROLE_ADMIN');

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('auth/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
