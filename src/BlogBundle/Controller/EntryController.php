<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Entry;
use BlogBundle\Form\EntryType;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class EntryController extends Controller
{
    /**
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showEntryBySlugAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entry = $em->getRepository('BlogBundle:Entry')->findOneBySlug($slug);

        if (is_null($entry)) {
            throw $this->createNotFoundException('No se ha encontrado ninguna entrada');
        }

        return $this->render(':Entry:show.html.twig', array(
            'entry' => $entry,
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showEntryByIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entry = $em->getRepository('BlogBundle:Entry')->findOneBySlug($id);

        if (is_null($entry)) {
            throw $this->createNotFoundException('No se ha encontrado ninguna entrada');
        }

        return $this->render(':Entry:show.html.twig', array(
            'entry' => $entry,
        ));
    }
}
