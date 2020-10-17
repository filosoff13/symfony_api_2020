<?php

namespace App\Controller;
use App\Services\Client\GuzzleClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Dictionary\Dictionary;
use App\Entity\Searches;

class SearchController extends AbstractController
{

    /**
     * @Route("/search", name="search")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getResult(Request $request, Dictionary $dictionary)
    {

        $word = $request->query->get('word');

        $result = $dictionary->entries('en-gb', $word);

        $this->addData($word);

        return $this->render('searchlayout.html.twig', [
            'word' => $word,
            'result' => $result,
        ]);
    }
    public function addData($word)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $existingWord = $entityManager->getRepository(Searches::class)->findBy(array('word' => $word));

        if (!$existingWord){
            $saveSearch = new Searches();
            $saveSearch->setWord($word)->setSearches(1);
        } else {
            $saveSearch = $existingWord[0]->setSearches($existingWord[0]->getSearches() + 1);
        }
        $entityManager->persist($saveSearch);
        $entityManager->flush();
    }
}