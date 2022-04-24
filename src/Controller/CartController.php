<?php

namespace App\Controller;

use App\Class\Cart;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(Cart $cart)
    {
        dd($cart->get());
        return $this->render('cart/index.html.twig');
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
}
