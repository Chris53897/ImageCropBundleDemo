<?php

namespace App\Form;

use App\Entity\UploadableDemo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadableDemoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageName')
            ->add('imageFile', 'Vich\UploaderBundle\Form\Type\VichImageType', [
                'crop' => true,
            ])
            ->add('button_submit', SubmitType::class, [ 'label' => 'speichern' ]);
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UploadableDemo::class,
        ]);
    }
}
