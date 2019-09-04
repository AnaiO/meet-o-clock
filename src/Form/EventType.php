<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Adress;
use App\Entity\Groups;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('date', DateTimeType::class)
            ->add('categories', EntityType::class, [
                'class' => Category::class
            ])
            ->add('adress', CollectionType::class, [
                'entry_type' => Adress::class
            ])
            ->add('groups', EntityType::class, [
                'class' => Groups::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'attr' => ['novalidate' => 'novalidate']
        ]);
    }
}
