<?php


namespace App\Controller;
use App\Form\CommentFormType;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/profile/comment", name="commentPage")
     */
    public function addComment()
    {
        $form = $this->createForm(CommentFormType::class);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $comment = new Comentario();

//            $manager->newUser($user); // HACER: ver si meto servicio
            $this->addFlash('success', "Comentario publicado correctamente");
        }

        return $this->render(
            'Profile/comment.html.twig',
            ['commentForm'=> $form-> createView()]
        );
    }
}