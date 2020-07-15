<?php

namespace App\Form;

use App\Entity\Fonction;
use App\Entity\Personnel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, [
                'required' => true,
                'attr' =>[
                    "class"=>"form-control small mb-5 form-control-sm",
                    "style"  =>"font-size: 11px"

                ]
            ])
            ->add('fonction',EntityType::class,[
                'class'=>Fonction::class,
                'choice_label'=>'libelle',
                'attr'=>[
                    'class'=>'custom-select'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
        ]);
    }
}
