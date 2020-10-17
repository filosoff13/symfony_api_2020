<?php


namespace App\Controller;


use App\Repository\SearchesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagsCloudController extends AbstractController
{
    /**
     * @Route("/tags", name = "tags")
     * @param SearchesRepository $repository
     * @return Response
     */
    public function tags(SearchesRepository $repository){
        $searches = $repository->getTop(10);

        return $this->render('tag_cloud.html.twig', [
            'searches' => $searches,
        ]);
    }

}