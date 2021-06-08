<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/", name="homePage")
     */
    public function homePage(): Response
    {
        return $this->render('Home/home.html.twig', []);
    }


/*    public function registerPage(): Response
    {
        return $this->render('Register/register.html.twig',[]);
    }*/

    /**
     * @Route("/login", name="loginPage")
     */
    public function loginPage(): Response
    {
        return $this->render('Login/login.html.twig', []);
    }

    /**
     * @Route("/profile", name="profilePage")
     */
    public function profilePage(): Response
    {
        return $this->render('Profile/profile.html.twig', ['comments'=>['comentario primero','comentario segundo','comentario tercero']]);
    }
}