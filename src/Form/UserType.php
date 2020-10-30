<?php 

namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\component\OptionsResolver\OptionsResolver;



class UserType extends AbstractType{

    public function buildForm(FormBuilderInterface $formBuilder, array $options){
             $formBuilder->add('username',TextType::class)
                         ->add('fullname',TextType::class)
                         ->add('email',EmailType::class)
                         ->add('plainPassword',RepeatedType::class,
                         [    'type' => passwordType::class,
                              'first_options' => ['label' => 'mot de passe*'],
                              'second_options' => ['label' => 'confirmation*']
                         ])

                         ->add('Valider',SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver){
           $resolver->setDefaults([
                  'data_class'=> User::class,
           ]);
    }


}