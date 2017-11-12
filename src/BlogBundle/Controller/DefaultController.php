<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function IndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entries = $em->getRepository('BlogBundle:Entry')->findRecentEntries();

        return $this->render('index.html.twig', array(
            'entries' => $entries,
        ));
    }
}
