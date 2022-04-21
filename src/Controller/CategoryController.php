<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/category/{id}', name: 'app_category')]
    public function show($id): Response
    {
        $category = $this->em->getRepository(Category::class)->find($id);
        $productsList = $this->em->getRepository(Product::class)->findAll();


        return $this->render('category/show.html.twig', [
            'category' => $category,
            'productsList' => $productsList
        ]);
    }
}
