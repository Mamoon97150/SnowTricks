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

        $page = (int)$request->query->get('page', 1);
        $limit = 6;

        $filters = $request->get('groups');

        $tricks= $this->tricksRepository->getTrickPaginator($page, $limit, $filters);
        foreach ($tricks as $trick){
            $trick->getMedias();
    }

        $count = $this->tricksRepository->getTrickCount($filters);

        $maxPage = ceil($count/$limit);

        $groups = $groupRepository->findAll();

        if ($request->get('filters')){
            return new JsonResponse([
                'content' => $this->renderView('home/_content.html.twig', ['tricks' => $tricks, 'maxPage' => $maxPage, 'page' => $page]),
            ]);
        }

        if ($request->get('load')){
            return new JsonResponse([
                'content' => $this->renderView('home/_tricks.html.twig', ['tricks' => $tricks, 'maxPage' => $maxPage, 'page' => $page]),
            ]);
        }


        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
            'groups' => $groups,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }
}