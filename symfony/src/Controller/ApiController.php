<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        throw new NotFoundHttpException();
    }
    
    
    
    /**
     * @Route("/api/getbylocode/{locode}", name="api_getbylocode", methods={"GET"})
     */
    public function getByLocode(EntityManagerInterface $em, $locode)
    {
        $location = $em->getRepository('App:LocationProd')
                ->findOneByLocode($locode);
        if ($location) {
            return new JsonResponse($location->getLocationData(), Response::HTTP_OK);
        } else {
            return new JsonResponse(null,Response::HTTP_NOT_FOUND);
        }
    }
    
    /**
     * @Route("/api/searchbyname/{name}", name="api_searchbyname", methods={"GET"})
     */
    public function getSearchByName(EntityManagerInterface $em, $name)
    {
        $locations = $em->getRepository('App:LocationProd')
                ->searchByName($name);
        
        if ($locations) {
            $data = [];
            foreach ($locations as $location){
                $data[] = $location->getLocationData();
            }
            return new JsonResponse($data, Response::HTTP_OK);
        } else {
            return new JsonResponse(null,Response::HTTP_NOT_FOUND);
        }
    }
    
    
}
