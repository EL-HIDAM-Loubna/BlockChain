<?php 
namespace App\Controller;



use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;




class SecurityController extends AbstractController{

/**
 * @Route("/login", name="security_login")
 */
public function login(AuthenticationUtils $authentication){
    return $this->render("security/login.html.twig",[
        'last_username' => $authentication->getLastUsername(),
        'error' => $authentication->getLastAuthenticationError()
    ]);
}


/**
 * @Route("/logout", name="security_logout")
 */

 public function logout(){
     
 }

}