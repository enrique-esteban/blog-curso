<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Category;
use BlogBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
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

        $categories = new Category();
        $categories = $em->getRepository('BlogBundle:Category')->findAll();

        return $this->render('BlogBundle:Category:show-all.html.twig', [
                'categories' => $categories,
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData();

                $em = $this->getDoctrine()->getManager();

                $category = new Category();
                $category->setName($data->getName());
                $category->setDescription($data->getDescription());

                $em->persist($category);

                $em->flush();

                $status = 'La categoría se ha creado correctamente';
            }
            else {
                $status = 'La categoría no se ha creado por que el formulario no es válido';
            }

            $this->session->getFlashBag()->add('status', $status);

            return $this->redirectToRoute('blog_index_category');
        }

        return $this->render('BlogBundle:Category:add.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('BlogBundle:Category')->find($id);

        if (!$category) {
            $this->createNotFoundException('No se puede borrar la categoría');
        }

        $this->get('session')->getFlashBag();

        if (count($category->getEntries()) == 0) {
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('blog_index_category');
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('BlogBundle:Category')->find($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData();

                $category->setName($data->getName());
                $category->setDescription($data->getDescription());

                $em->persist($category);

                $em->flush();

                $status = 'La categoría se ha editado correctamente';
            } else {
                $status = 'La categoría no se puede editar por que el formulario no es válido';
            }

            $this->session->getFlashBag()->add('status', $status);

            return $this->redirectToRoute('blog_index_category');
        }

        return $this->render('BlogBundle:Category:edit.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuCategoriesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('BlogBundle:Category')->findAll();

        return $this->render('@Blog/Category/menuCategories.html.twig', array(
            'categories' => $categories,
        ));
    }

    public function readCategoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('BlogBundle:Category')->find($id);
        $categories = $em->getRepository('BlogBundle:Category')->findAll();

        return $this->render('BlogBundle:Category:read-category.html.twig', array(
            'category' => $category,
            'categories' => $categories,
        ));
    }
}
