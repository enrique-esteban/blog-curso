<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => 'Nombre de usuario',
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-name form-control'
                )
            ))
            ->add('name', TextType::class, array(
                'label' => 'Nombre',
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-name form-control'
                )
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'Apellidos',
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-name form-control'
                )
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-email form-control'
                )
            ))
            ->add('password', PasswordType::class, array(
                'label' => 'Contraseña',
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-password form-control'
                )
            ))
            ->add('Guardar', SubmitType::class, array(
                'attr' => array(
                    'class' => 'form-submit btn btn-primary'
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blogbundle_user';
    }
}
