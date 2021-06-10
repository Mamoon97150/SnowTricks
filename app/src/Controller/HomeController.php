<?php


namespace App\Controller;


use App\Entity\Tricks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $tricks= $this->getDoctrine()->getRepository(Tricks::class)->findAll();

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}