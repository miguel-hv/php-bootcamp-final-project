<?php


namespace App\Controller;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    /**
     * @Route("/profile", name="profilePage")
     * @IsGranted("ROLE_USER")
     */
    public function profilePage( EntityManagerInterface $doctrine)
    {
        $repo = $doctrine->getRepository(Comment::class);

//        $comments = $repo->findAll();
        $comments = $repo->findAllOrderedByDate();

        return $this->render(
            'Profile/profile.html.twig',
        ["commentsTwig"=>$comments]);
    }
    /**
     * @Route("/profile/delete/{id}", name="deletePage")
     * @IsGranted("ROLE_USER")
     */
    public function deleteComment($id, EntityManagerInterface $doctrine)
    {
        $comment = $doctrine->getRepository(Comment::class)->find($id);
        $doctrine->remove($comment);
        $doctrine->flush();
        return $this->redirectToRoute('profilePage');
    }


    /**
     * @Route("/profile/post", name="commentPage")
     *  @IsGranted("ROLE_USER")
     */
    public function addComment(Request $request, EntityManagerInterface $doctrine): Response
    {
        $form = $this->createForm(CommentFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();
            $idUser = $this->getUser();
            $NameUser = $idUser->getUsername();
            $comment->setCodUser($idUser);
            $comment->setName($NameUser);

            $doctrine->persist($comment);
            $doctrine->flush();

//            $this->addFlash('success', "Comentario publicado correctamente");
            return $this->redirectToRoute('profilePage');
        }

        return $this->render(
            'Profile/comment.html.twig',
            ['commentForm'=> $form-> createView()]
        );
    }
}