<?php

namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation',TextType::class, [
                'required' => true,
                'attr' =>[
                    "class"=>"form-control small mb-3 form-control-sm",
                    "style"  =>"font-size: 11px"

                ]
            ])
            ->add('prixUnitaire',NumberType::class, [
                'required' => true,
                'attr' =>[
                    "class"=>"form-control small mb-3 form-control-sm",
                    "style"  =>"font-size: 11px"

                ]
            ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
