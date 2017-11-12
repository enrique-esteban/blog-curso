<?php

namespace BlogBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Título',
                'required' => 'required',
                'attr' => [
                    'class' => 'form-name form-control'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenido',
                'required' => 'required',
                'attr' => [
                    'class' => 'form-name form-control'
                ]
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Estado',
                'required' => 'required',
                'choices' => [
                    'Público' => 'public',
                    'Privado' => 'private'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Imagen',
                'required' => 'required',
                'attr' => [
                    'class' => 'form-control'
                ],
                'data_class' => null
            ])
            ->add('category', EntityType::class, [
                'class' => 'BlogBundle\Entity\Category',
                'label' => 'Categorías',
                'required' => 'required',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('tags', TextType::class, [
                'mapped' => false,
                'label' => 'Etiquetas',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Guardar', SubmitType::class, [
                'attr' => [
                    'class' => 'form-submit btn btn-success'
                ]
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Entry'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blogbundle_entry';
    }


}
