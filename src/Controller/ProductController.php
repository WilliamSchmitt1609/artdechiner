<?php

namespace App\Controller;

use App\Entity\Product;
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
        
        return $this->render('product/index.html.twig', [
            'productsList' => $productsList
        ]);
    }

    #[Route('/nos-objets/{slug}', name: 'app_product')]
    public function show($slug)
    {
        $product = $this->em->getRepository(Product::class)->findOneBy(['slug' => $slug
    ]);

        return $this->render('product/show.html.twig', [
            'slug' => $slug ,
            'product' => $product
        ]);
    }

}
