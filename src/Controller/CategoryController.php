<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/{categoryName}", name="show")
     */
    public function show(string $categoryName)
    {

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($categoryName);

        if(!$category) {
            throw $this->createNotFoundException(
                'The' .$categoryName . ' is not found.'
            );
        }

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findByCategory($category->getId(), ['id' => 'DESC'], 3);

        return $this->render('category/show.html.twig', [
            'programs'      => $programs,
            'categoryName' => $categoryName,
        ]);
    }
}