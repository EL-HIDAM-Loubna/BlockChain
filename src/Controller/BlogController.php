<?php 
namespace App\Controller;
use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class BlogController extends AbstractController{
  private $formFactory;
  private $entityManager;  
  private $router;
  private $flashMessage;


    public function __construct(FormFactoryInterface $formFactory,EntityManagerInterface $entityManager, RouterInterface $router, FlashBagInterface $flashMessage)
    {
      $this->formFactory=$formFactory;
      $this->entityManager=$entityManager;
      $this->router=$router;
      $this->flashMessage =$flashMessage;
    }


    
    /**
     * @Route("/",name="home")
     */
    public function index(){
     $repository= $this->getDoctrine()->getRepository(Post::class);
     $posts = $repository->findAll();
       // return new Response('hello World');
     return $this->render('index.html.twig',[ 'posts'=>$posts ]);
    }



    
    /**
     * @Route("/blog/show/{id}",name="post_show")
     */
    public function show($id){
      $repository = $this->getDoctrine()->getRepository(Post::class);
      $post = $repository->find($id);
      return $this->render('show.html.twig',['post'=>$post]);
   }




    /**
     * @Route("/add",name="post_add")
     */
    public function add( Request $request , UserInterface $user){
         $post = new Post();
         $post->setUser($user);
         $form = $this->formFactory->create(PostType::class,$post);
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
           $this->entityManager->persist($post);
           $this->entityManager->flush();
           return new RedirectResponse(
             $this->router->generate('home')
           );
         }
         return $this->render('add.html.twig',['form'=>$form->createView()]);
    }





    /**
     * @Route("blog/edit/{id}",name="post_edit")
     */


     public function edit(Post $post, Request $request){
          $this->denyAccessUnlessGranted('edit',$post);

         $form= $this->formFactory->create(PostType::class,$post);
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
           $this->entityManager->flush();
           return new RedirectResponse(
             $this->router->generate('home')
           );
         }
         return $this->render('edit.html.twig',['form'=>$form->createView()]);
     }




     /**
      * @Route("blog/delete/{id}", name="post_delete")
      */
     public function delete(Post $post){
         $this->denyAccessUnlessGranted('delete',$post);

         $this->entityManager->remove($post);
         $this->entityManager->flush();
         $this->flashMessage->add('notice','this article deleted with success!');
         return new RedirectResponse(
           $this->router->generate('home')
         );
     }

}

?>