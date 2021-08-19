<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeUserController extends AbstractController
{
    
     /**
     * @Route("/home/user/{id}", name="home_user")
     * @Route("/home/user", name="home_user1")
     *
     */

    public function index($id = null, Request $request): Response
    {
        // Lấy list Category và list Product

        $name =  $request->query->get('name');

        if ($id != null) {
            $products = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->findBy(['category' => $id]);
        }  
        else {
            $products = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->findAll();
        }


        if ($name != null) {
            $products = $this->getDoctrine()
                            ->getRepository(Product::class)
                            ->search($name);
        }
        

               


        
        $category = $this->getDoctrine()
                        ->getRepository(Category::class)
                        ->findAll();

       
        return $this->render('homeuser/index.html.twig', [
            "products" => $products, 
            'controller_name' => 'HomeUserController',
            'category' => $category,
        ]);
    }
}
