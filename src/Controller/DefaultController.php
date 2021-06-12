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
        return $this->render('Registration/register.html.twig',[]);
    }*/

/*    public function loginPage(): Response
    {
        return $this->render('Login/login.html.twig', []);
    }*/

}