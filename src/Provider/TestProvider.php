<?php

namespace App\Provider;

use FOS\ElasticaBundle\Provider\PagerfantaPager;
use FOS\ElasticaBundle\Provider\PagerProviderInterface;
use Pagerfanta\Adapter\CallbackAdapter;
use Pagerfanta\Pagerfanta;

class TestProvider implements PagerProviderInterface
{
    /**
     * @param array $options
     *
     * @return PagerfantaPager|\FOS\ElasticaBundle\Provider\PagerInterface
     */
    public function provide(array $options = array())
    {
        $totalResultsCount = function () {
            return 10;
        };

        $getSliceCallback = function ($offset, $limit) {
            $obj = new \stdClass();
            $obj->id = time();
            $obj->username = 'leo';
            $obj->firstName = 'leo';
            $obj->lastName = 'beal';

            return [$obj];
        };

        $pager = new PagerfantaPager(new Pagerfanta(new CallbackAdapter($totalResultsCount, $getSliceCallback)));


        return $pager;
    }
}