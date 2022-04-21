<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{


    private $em;

    public function __construct (EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/nos-objets', name: 'app_products')]
    public function index(): Response
    {
        $productsList = $this->em->getRepository(Product::class)->findAll();
        $categoriesList = $this->em->getRepository(Category::class)->findAll();
        
        return $this->render('product/index.html.twig', [
            'productsList' => $productsList,
            'categoriesList' =>$categoriesList
        ]);
    }

    #[Route('/objet/{slug}', name: 'app_product')]
    public function show($slug)
    {
        $product = $this->em->getRepository(Product::class)->findOneBy(['slug' => $slug
    ]);

        if(!$product){
            return $this->redirectToRoute('app_products');
        }

        return $this->render('product/show.html.twig', [
            'slug' => $slug ,
            'product' => $product
        ]);
    }

}
