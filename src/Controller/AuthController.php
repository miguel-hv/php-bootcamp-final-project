<?php


namespace App\Controller;
use App\Form\registerFormType;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthController extends AbstractController
{
    /**
     * @Route("/register", name="registerPage")
     */
    public function register()
    {
        $form = $this->createForm(registerFormType::class);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

//            $manager->newUser($user); // HACER: ver si meto servicio
            $this->addFlash('success', "Usuario registrado correctamente");
        }

        return $this->render(
            'Register/register.html.twig',
            ['registerForm'=> $form-> createView()]
        );
    }
}