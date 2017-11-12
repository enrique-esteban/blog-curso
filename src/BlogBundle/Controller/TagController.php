<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Tag;
use BlogBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller
{
    private $session;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tag = new Tag();
        $tag = $em->getRepository('BlogBundle:Tag')->findAll();

        return $this->render('BlogBundle:Tag:show-all.html.twig', [
                'tags' => $tag,
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $tag = new Tag();

        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData();
                $tag = new Tag();
                $em = $this->getDoctrine()->getManager();

                $tag->setName($data->getName());
                $tag->setDescription($data->getDescription());

                $em->persist($tag);

                $em->flush();

                $status = 'La etiqueta se ha creado correctamente';
            }
            else {
                $status = 'La etiqueta no se ha creado por que el formulario no es válido';
            }

            $this->session->getFlashBag()->add('status', $status);

            return $this->redirectToRoute('blog_index_tag');
        }

        return $this->render('BlogBundle:Tag:add.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('BlogBundle:Tag')->find($id);

        if (!$tag) {
            $this->createNotFoundException('No se puede borrar la etiqueta');
        }

        $this->get('session')->getFlashBag();

        if (count($tag->getEntryTag()) == 0) {
            $em->remove($tag);
            $em->flush();
        }

        return $this->redirectToRoute('blog_index_tag');
    }
}
