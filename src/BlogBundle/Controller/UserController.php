<?php

namespace BlogBundle\Controller;

use BlogBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    private $session;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $user_repo = $em->getRepository('BlogBundle:User');
            $user = $user_repo->findBy(array('email' => $data->getPassword()));

            if (count($user) === 0) {
                $user = new User();

                $user->setName($data->getName());
                $user->setLastName($data->getSurname());
                $user->setEmail($data->getEmail());
                $user->setRole('ROLE_USER');
                $user->setImage(null);

                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $encodePass = $encoder->encodePassword($data->getPassword(), null);

                $user->setPassword($encodePass);

                $em = $this->getDoctrine()->getManager();

                $em->persist($user);

                $em->flush();

                $status = 'El usuario se ha creado correctamente';
            } else {
                $status = 'El usuario introducido ya existe';
            }

            $this->session->getFlashBag()->add('status', $status);
        }

        return $this->render(':User:login.html.twig', array(
            'error' => $error,
            'form' => $form->createView(),
            'lastUsername' => $lastUsername,
        ));
    }
}
