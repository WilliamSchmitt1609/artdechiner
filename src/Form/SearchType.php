<?php

namespace App\Form;

use App\Class\Search;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add ('string', TextType::class, [
                'label' => 'Renseignez vos critères',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher...'
                ]
            ])
            ->add ('categories', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true,

            ])
            
            ->add('submit', SubmitType::class, [
                'label' => 'Validez votre recherche',
                'attr' => [
                    'class' => 'btn-block btn-success'
                ]
            ])
        ;
    }  
      
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' =>'GET',
            'csrf_protection' => false,
        ]);
    }

    /**
     * pas d'URL 'search'
     */
    public function getBlockPrefix () {
        return '';
    }



}