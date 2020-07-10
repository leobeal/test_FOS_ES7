<?php

namespace App\Controller;

use Elastica\Query;
use FOS\ElasticaBundle\Index\IndexManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /** @var IndexManager */
    private $indexManager;

    /**
     * TestController constructor.
     * @param IndexManager $indexManager
     */
    public function __construct(IndexManager $indexManager)
    {
        $this->indexManager = $indexManager;
    }


    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        $index = $this->indexManager->getIndex();

        $value = 'leo';

        //$query = new Query();
        $match = new Query\Match();
        $match->setField('username',$value);

        foreach ($index->search($match)->getResults() as $result){
            dump($result->getData());
        }

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
