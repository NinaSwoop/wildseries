<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $catergoryRepository): Response
    {
        $categories = $catergoryRepository->findAll();

        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }

    #[Route('{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $catergoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $catergoryRepository->findOneBy(['name' => $categoryName]);
        // same as $program = $programRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category : ' . $categoryName . ' found in categories\'s table.'
            );
        }
        $programs = $programRepository->findBy(['category' => $category->getId()], ['id' => 'DESC'], 3);
        return $this->render('category/show.html.twig', ['category' => $category, 'programs' => $programs]);
    }
}
