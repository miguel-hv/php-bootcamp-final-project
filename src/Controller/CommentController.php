<?php


namespace App\Controller;
use App\Entity\Comment;
use App\Form\CommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    /**
     * @Route("/profile", name="profilePage")
     */
    public function profilePage( EntityManagerInterface $doctrine)
    {
        $repo = $doctrine->getRepository(Comment::class);

        $comments = $repo->findAll();

        return $this->render(
            'Profile/profile.html.twig',
        ["commentsTwig"=>$comments]);
    }
    /**
     * @Route("/profile/comment", name="commentPage")
     */
    public function addComment(Request $request, EntityManagerInterface $doctrine)
    {
        $form = $this->createForm(CommentFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();
//            $comment = new Comment($data['name'], $data['title']);

            $doctrine->persist($comment);
            $doctrine->flush();

            $this->addFlash('success', "Comentario publicado correctamente");
//            return $this->render(
//                'Profile/profile.html.twig',
//                [$comment]
//            );
        }

        return $this->render(
            'Profile/comment.html.twig',
            ['commentForm'=> $form-> createView()]
        );
    }
}