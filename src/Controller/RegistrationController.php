<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\RegisterFormType;
use App\Security\LoginAuthAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="registerPage")
     */
    public function register(
        EntityManagerInterface $doctrine,
        Request $request,
        UserPasswordEncoderInterface $encoder,
        GuardAuthenticatorHandler $guard, LoginAuthAuthenticator $formAuthenticator)
    {
        $user = new User();
        $registerForm = $this -> createForm(RegisterFormType::class, $user);

        $registerForm->handleRequest($request);

        if($registerForm->isSubmitted() && $registerForm->isValid()){
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setRoles(["user"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $guard->authenticateUserAndHandleSuccess(
                $user, $request, $formAuthenticator, 'main');
//            $this->addFlash('success', 'Ha ocurrido un error con el registro');
        }

        return $this->render(
            'Registration/register.html.twig',
            array('registerForm' => $registerForm->createView())
        );
    }
}