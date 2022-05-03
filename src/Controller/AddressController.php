<?php

namespace App\Controller;

use App\Class\Cart;
use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddressController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('account/address', name: 'app_address')]
    public function index(): Response
    {
        return $this->render('address/index.html.twig');
    }

    #[Route('account/add/address', name: 'app_new_address')]
    public function add(Cart $cart, Request $request): Response
    {
        $address = new Address;
        
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $address->setUser($this->getUser());

            $this->em->persist($address);
            $this->em->flush();
            if($cart->get()){
                return $this->redirectToRoute('app_order');
            } else {
            return $this->redirectToRoute('app_address');
            }
        }

        return $this->render('address/add.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('account/update/address/{id}', name: 'app_edit_address')]
    public function update(Request $request, $id): Response
    {
        $address = $this->em->getRepository(Address::class)->find($id);

        if(!$address || $address->getUser() != $this->getUser()) {
            return $this->redirectToRoute('app_address');
        }
        
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('app_address');
        }

        return $this->render('address/add.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('account/delete/address/{id}', name: 'app_delete_address')]
    public function delete($id): Response
    {
        $address = $this->em->getRepository(Address::class)->find($id);

        if($address || $address->getUser() == $this->getUser()) {
            $this->em->remove($address);
            $this->em->flush();
        }
        
         return $this->redirectToRoute('app_address');
        
    }
}
