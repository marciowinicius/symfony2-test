<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Person;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class PersonController extends FOSRestController
{

    /**
     * Return person data by ID
     *
     *
     * @ApiDoc(
     *  resource=true,
     *  filters={
     *      {"name"="id", "dataType"="integer"}
     *  }
     * )
     *
     *
     * @Route("/api/person/{id}")
     * @Method({"GET"})
     */
    public function getById($id)
    {
        $data = $this->getDoctrine()
            ->getRepository(Person::class)
            ->find($id);

        $getView = View::create();
        $getView->setData($data)->setStatusCode(200);

        return $getView;
    }

    /**
     * Return person data
     *
     *
     * @ApiDoc(
     *  resource=true
     * )
     *
     *
     * @Route("/api/person")
     * @Method({"GET"})
    */
    public function getAll()
    {
        $data = $this->getDoctrine()
            ->getRepository(Person::class)
            ->findAll();

        $getView = View::create();
        $getView->setData($data)->setStatusCode(200);

        return $getView;
    }
}
