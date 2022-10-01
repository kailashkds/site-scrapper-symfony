<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    const PAGINATION_LIMIT = 10;

    private NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
    
    /**
     * @Route("/", name="home_page")
     */
    public function homePage(Request $request, PaginatorInterface $paginator): Response
    {
        $page = $request->query->getInt('page', 1);
        $news = $this->newsRepository->createQueryBuilder('s')->getQuery();;
        $data['news'] = $this->knpPaginator($news, $page, $request->query->getInt('limit', self::PAGINATION_LIMIT), $paginator);
        return $this->render('home/index.html.twig', $data);
    }

    /**
     *
     * @param type $news
     * @param type $page
     * @param type $limit
     * @return type
     */
    private function knpPaginator($news, $page = 1, $limit = self::PAGINATION_LIMIT, $paginator)
    {
        /*
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        return $paginator->paginate(
            $news,
            $page,
            $limit
        );
    }
}
