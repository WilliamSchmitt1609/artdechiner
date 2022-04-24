<?php

namespace App\Class;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Service for managing website cart
 */

class Cart 
{
    private $session;
    private $em;

    /**
     * Instances of session and Doctrine
     */
    public function __construct(RequestStack $session, EntityManagerInterface $em){

        $this->session = $session;
        $this->em = $em;
    }

    /**
     * Function to add new product in cart
     */
    public function add($id){

        $cart = $this->session->getSession()->get('cart', []);

        if(!empty($cart[$id])){
            $cart[$id] ++;
        }else{
            $cart[$id] = 1;
        }


        $this->session->getSession()->set('cart', $cart);

    }

    /**
     * Function to read the cart
     */
    public function get(){
        return $this->session->getSession()->get('cart');
    }

    /**
     * Function to remove all products in cart
     */
    public function remove(){
        return $this->session->getSession()->remove('cart');
    }

    /**
     * Function to delete one product type in cart
     */
    public function delete($id){

        $cart = $this->session->getSession()->get('cart', []);
        unset($cart[$id]);

        return $this->session->getSession()->set('cart', $cart);
    }

    /**
     * Function to delete one product in cart
     */
    public function decrement($id){

        $cart = $this->session->getSession()->get('cart', []);

        if($cart[$id] > 1){
            $cart[$id] --;
        }else{
            unset($cart[$id]);
        }
        return $this->session->getSession()->set('cart', $cart);
    }


    /**
     * Function for reading the cart
     */
    public function getFullCart() {
        $fullCart = [];

        if($this->get()){
            foreach($this->get() as $id =>$quantity){
                $product = $this->em->getRepository(Product::class)->findOneById($id);

                //To protect against fake id in URL
                if(!$product){
                    $this->delete($id);
                    continue;
                }

                $fullCart [] = [
                    'product' => $product , 
                    'quantity' => $quantity
                ];

            }
        }
        return $fullCart;
    }
}