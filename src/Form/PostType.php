<?php 

namespace App\Form;
use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\component\OptionsResolver\OptionsResolver;



class PostType extends AbstractType{

    public function buildForm(FormBuilderInterface $formBuilder, array $options){
             $formBuilder->add('title',TextType::class,['label'=>false])
                         ->add('body',TextareaType::class,['label'=>false])
                         ->add('Valider',SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver){
           $resolver->setDefaults([
                  'data_class'=> Post::class,
           ]);
    }


}