<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use function PHPUnit\Framework\throwException;

class ProductController extends AbstractController
{

      /**
     * @Route ("/product", name="product_index")
     */
    public function indexProduct() {
        $products = $this->getDoctrine()
                       ->getRepository(Product::class)
                       ->findAll();

                       
        return $this->render(
            "product/index.html.twig",
            [
               "products" => $products 
            ]
        );
    }

     /**
     * @Route("product/create", name="product_create")
     */
    public function createnewProduct(Request $request) {
        $product = new Product();        
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        // print_r("submit");
        // print_r($form->isSubmitted());
        // print_r("valid");
        // print_r($form->isValid());
        if ($form->isSubmitted() ) {
            // print_r("aaa");
            // get picture from upload file
            $picture = $product->getPicture();

            // create a unique picture name
            $fileName = md5(uniqid());

            // get picture extension
            $fileExtension = $picture->guessExtension();
            
            //merger picture name & picture extension => get a complete picture name
            $pictureName = $fileName . '.' . $fileExtension;

            // move upload file to a predefined location
            try {
                $picture->move(
                    $this->getParameter('product_picture'), $pictureName
                );


            } catch (FileException $e) 
            {
                throwException($e);
            }

            // set pictureName to database
            $product->setPicture($pictureName);

            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($product);
            $manager->flush();
            $this->addFlash("Info","Add successfully !");
            return $this->redirectToRoute("product_index");
        } 

        return $this->render(
            "product/create.html.twig",
            [
                'form' => $form->createView()
            ]
        );
    }

     /**
     * @Route ("/product/delete/{id}", name="product_delete")
     */
    public function deleteProduct($id) {
        $product = $this->getDoctrine()
                      ->getRepository(Product::class)
                      ->find($id);
        if ($product == null) {
            $this->addFlash("Error","Delete failed !");
            return $this->redirectToRoute("product_index");
        }
        //if genre is not null
        $manager = $this->getDoctrine()
                        ->getManager();
        $manager->remove($product);
        $manager->flush();
        $this->addFlash("Info","Delete succeed !");
        return $this->redirectToRoute("product_index");
    }


     /**
     * @Route ("/product/detail/{id}", name="product_detail")
     */
    public function viewdetailProduct($id) {
            $product = $this->getDoctrine()
                           ->getRepository(Product::class)
                           ->find($id);
            return $this->render(
                "product/detail.html.twig",
                [
                   "product" => $product
                ]
            );
    }

    /**
    * @Route ("/product/update/{id}", name="product_update")
    */
    public function updateProduct(Request $request, $id) {
        $product = $this->getDoctrine()
                      ->getRepository(Product::class)
                      ->find($id);      
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            $uploadFile = $form['picture']->getData(); 
            
            if ($uploadFile != null) {
                // get picture from upload file
                $picture = $product->getPicture();
        
                // create a unique picture name
                $fileName = md5(uniqid());
        
                // get picture extension
                $fileExtension = $picture->guessExtension();
                
                //merger picture name & picture extension => get a complete picture name
                $pictureName = $fileName . '.' . $fileExtension;
        
                // move upload file to a predefined location
                try {
                    $picture->move(
                        $this->getParameter('product_picture'), $pictureName
                    );
        
        
                } catch (FileException $e) 
                {
                    throwException($e);
                }
        
                // set pictureName to database
                $product->setPicture($pictureName);
            }


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($product);
            $manager->flush();
            $this->addFlash("Info","Update successfully !");
            return $this->redirectToRoute("product_index");
        }  

        return $this->render(
            "product/update.html.twig",
            [
                'form' => $form->createView()
            ]
        );
    }

























    // #[Route('/', name: 'product_index', methods: ['GET'])]
    // public function index(ProductRepository $productRepository): Response
    // {
    //     return $this->render('product/index.html.twig', [
    //         'products' => $productRepository->findAll(),
    //     ]);
    // }

    // /**
    //  * @Route("/create/",name="product_create")
    //  */
    // public function create(Request $request)
    // {
    //     $product = new Product();
    //     $form = $this->createForm(ProductType::class, $product);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($product);
    //         $em->flush();

    //         $this->addFlash("Notice", "Product added successfully !");
    //         return $this->redirectToRoute('product_index');
    //     }
    //     return $this->render("product/create.html.twig",
    //             [
    //                 'form' => $form->createView()
    //             ]);
    // }

    // #[Route('/{id}', name: 'product_show', methods: ['GET'])]
    // public function show(Product $product): Response
    // {
    //     return $this->render('product/show.html.twig', [
    //         'product' => $product,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'product_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Product $product): Response
    // {
    //     $form = $this->createForm(ProductType::class, $product);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('product/edit.html.twig', [
    //         'product' => $product,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'product_delete', methods: ['POST'])]
    // public function delete(Request $request, Product $product): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($product);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    // }
}
