<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class PagesController extends FOSRestController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {
        $getView = $this->view(null, 200)->setTemplate('default/upload.html.twig');

        return $this->handleView($getView);
    }
}
