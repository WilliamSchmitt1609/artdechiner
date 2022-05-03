<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Shipping;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
            ->add('addresses', EntityType::class, [
                'label' => 'Votre adresse de livraison',
                'required' => true,
                'class' => Address::class,
                'choices' => $user->getAddresses(),
                'multiple' => false,
                'expanded' => true
            ])

            ->add('shipping', EntityType::class, [
                'label' => 'Votre choix de livraison',
                'required' => true,
                'class' => Shipping::class,
                'multiple' => false,
                'expanded' => true
            ])

        
            ->add('submit', SubmitType::class, [
                'label' => 'Validez votre commande',
                'attr' => ['btn btn-success btn-block']
            ])    
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user' => array()
        ]);
    }
}
