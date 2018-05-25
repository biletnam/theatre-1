<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class UtilisateurEvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('disponibilite',ChoiceType::class,array('choices'=>array('Disponible'=>'Disponible','à confirmer'=>'à confirmer','Non Précisé'=>'Non Précisé')))
        ->add('commentaire',TextareaType::class)
        ->add('souhait',TextType::class)
        ->add('horaireDispo',TimeType::class)
        ->add('vehicule',ChoiceType::class,array('choices'=>array('Oui'=>'Oui','Non'=>'Non')))
        ->add('placeHebergement',ChoiceType::class,array('choices'=>array('1'=>'1','2'=>'2','3'=>'3')))
        ->add('submit',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\UtilisateurEvenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_utilisateurevenement';
    }


}
