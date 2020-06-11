<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    public function index(Request $request, $entityId): Response
    {
        var_dump($entityId, $request->getLocale(), $request->getPathInfo());
        return $this->render('base.html.twig');
    }
}
