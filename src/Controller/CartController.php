<?php

namespace App\Controller;

use App\Class\Cart;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    #[Route('/mon-panier', name: 'app_cart')]
    public function index(Cart $cart)
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFullCart()
        ]);
    }

    #[Route('/cart/add/{id}', name: 'add_product_to_cart')]
    public function add(Cart $cart, $id)
    {

        $cart->add($id);

        return $this->redirectToRoute('app_cart');

    }

    #[Route('/cart/remove', name: 'remove_product_to_cart')]
    public function remove(Cart $cart)
    {

        $cart->remove();

        return $this->redirectToRoute('app_products');

    }

    
    #[Route('/cart/delete/{id}', name: 'delete_product_to_cart')]
    public function delete(Cart $cart, $id)
    {

        $cart =  $cart->delete($id);

        return $this->redirectToRoute('app_cart');

    }

    #[Route('/cart/decrement/{id}', name: 'delete_one_product_to_cart')]
    public function decrement(Cart $cart, $id)
    {

        $cart =  $cart->decrement($id);

        return $this->redirectToRoute('app_cart');

    }
}
