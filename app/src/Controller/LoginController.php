<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/signin", name="sign_in")
     */
    public function signIn()
    {
        return $this->render('login/signin.html.twig');
    }
}