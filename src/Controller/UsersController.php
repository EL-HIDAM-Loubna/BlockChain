<?php 
namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;



class UsersController extends AbstractController{

/**
 * @Route("/register", name="register_user")
 */
public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder){
    $user = new User();
    $form = $this->createForm(UserType::class,$user);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $password = $passwordEncoder->encodePassword(
            $user, $user->getPlainPassword()
        );
        $user->setPassword($password);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }

    return $this->render('register/register.html.twig',[
             'form' => $form->createView()
    ]);

}



}