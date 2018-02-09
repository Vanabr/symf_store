<?php

namespace App\Controller;

use App\Domain\DTO\CategoryDTO;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends Controller
{
    /**
     * @Route("/")
     * 
     */
    public function index() {
        $em = $this->getDoctrine()->getManager();
        $dto = new CategoryDTO();
        $dto->title = 'test';
        $category = new Category($dto);
        $em->persist($category);
        $em->flush();


        return $this->render('main.html.twig');
    }
}
