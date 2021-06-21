<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\Tricks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //TODO: add constraints
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('group', EntityType::class,
            [
                'class' => Group::class,
                'choice_label' => 'name'
            ])
           /* ->add('medias', CollectionType::class, [
                'entry_type' => MediaFormType::class,
                'entry_options' => ['label' => false]
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }
}
