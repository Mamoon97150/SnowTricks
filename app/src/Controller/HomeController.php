<?php


namespace App\Controller;


use App\Entity\Tricks;
use App\Repository\GroupRepository;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    private TricksRepository $tricksRepository;

    public function __construct(TricksRepository $trickRepository, Security $security)
    {
        $this->tricksRepository = $trickRepository;
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index(Request $request, GroupRepository $groupRepository): Response
    {

        $page = (int)$request->query->getInt('page', 1);
        $limit = 6;


        $tricks= $this->tricksRepository->getTrickPaginator($page, $limit);
        foreach ($tricks as $trick){
            $trick->getMedias();
        }

        $count = $this->tricksRepository->getTrickCount();

        $maxPage = ceil($count/$limit);

        $groups = $groupRepository->findAll();


        if ($request->get('load')){
            return new JsonResponse([
                'content' => $this->renderView('home/_tricks.html.twig', ['tricks' => $tricks, 'maxPage' => $maxPage, 'page' => $page]),
                'maxPage' => $maxPage
            ]);
        }

        return $this->render('home/index.html.twig', [
            'page' => $page,
            'maxPage' => $maxPage,
            'tricks' => $tricks,
            'groups' => $groups
        ]);
    }
}