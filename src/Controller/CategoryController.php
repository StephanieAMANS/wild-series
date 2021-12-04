<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('category_index');

        }
        return $this->renderForm('category/new.html.twig', [
            'form' => $form,
        ]);
    }
    /**
     * @Route("/{categoryName}", name="show")
     */
    public function show(Category $category)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($category);

        if(!$category) {
            throw $this->createNotFoundException(
                'The' .$category . ' is not found.'
            );
        }

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findByCategory($category->getId(), ['id' => 'DESC'], 3);

        return $this->render('category/show.html.twig', [
            'programs'      => $programs,
            'category' => $category,
        ]);
    }

}