<?php

namespace App\Controller;

use App\Factory\ElasticsearchFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    /**
     * @var ElasticsearchFactory
     */
    private $elasticsearchFactory;

    public function __construct(ElasticsearchFactory $elasticsearchFactory)
    {
        $this->elasticsearchFactory = $elasticsearchFactory;
    }

    public function index(Request $request, $entityId): Response
    {
        $params = [
            'index' => 'magento2_de_catalog_product',
            'type' => 'product',
            'body'  => [
                'from' => 0, 'size' => 50,
                'query' => [
                    'terms' => [
                        'category_codes' => [(int)$entityId]
                    ]
                ]
            ]
        ];
        $es = $this->elasticsearchFactory->create();
        $hits = $es->search($params)['hits']['hits'];
        $products = array_column($hits, '_source');
        var_dump($entityId, $request->getLocale(), $request->getPathInfo(), $hits, $products);
        return $this->render('base.html.twig');
    }
}
