<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_index")
     */
    public function indexCategory() 
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render(
            'category/index.html.twig',
            [
                'category' => $category
            ]
        );
    }

    /**
     * @Route("/category/detail/{id}", name="category_detail")
     */
    public function detailCategory($id) {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        return $this->render(
            'category/detail.html.twig',
            [
                'category' => $category
            ]
        );
    }

    /**
     * @Route("/category/delete/{id}", name="category_delete")
     */
    public function deleteCategory($id) {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $chkProduct = $category->getProducts();
        
        if ($category == null) {
            $this->addFlash("Error", "Delete category failed !");
            return $this->redirectToRoute("category_index");
        }

        if (count($chkProduct) > 0 ) {
            $this->addFlash("Error", "Delete failed category already has product! ");
            return $this->redirectToRoute("category_index");
        }


        $manager = $this->getDoctrine()->getManager();
        $manager->remove($category);
        $manager->flush();

        $this->addFlash("Info","Delete category succeed !");
        return $this->redirectToRoute("category_index");
    }

    /**
     * @Route("category/create", name="category_create")
     */
    public function createCategory(Request $request) {
        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();

            $this->addFlash("Info", "Create category succeed !");
            return $this->redirectToRoute("category_index"); 
        }

        return $this->render(
            'category/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("category/update/{id}", name="category_update")
     */
    public function updateCategory(Request $request, $id) {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();

            $this->addFlash("Info", "Update category succeed !");
            return $this->redirectToRoute("category_index"); 
        }

        return $this->render(
            'category/update.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }



























    // #[Route('/', name: 'category_index', methods: ['GET'])]
    // public function index(CategoryRepository $categoryRepository): Response
    // {
    //     return $this->render('category/index.html.twig', [
    //         'categories' => $categoryRepository->findAll(),
    //     ]);
    // }

    // #[Route('/create', name: 'category_create', methods: ['GET', 'POST'])]
    // public function new(Request $request): Response
    // {
    //     $category = new Category();
    //     $form = $this->createForm(CategoryType::class, $category);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($category);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('category/create.html.twig', [
    //         'category' => $category,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'category_show', methods: ['GET'])]
    // public function show(Category $category): Response
    // {
    //     return $this->render('category/show.html.twig', [
    //         'category' => $category,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'category_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Category $category): Response
    // {
    //     $form = $this->createForm(CategoryType::class, $category);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('category/edit.html.twig', [
    //         'category' => $category,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'category_delete', methods: ['POST'])]
    // public function delete(Request $request, Category $category): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($category);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
    // }


      
    // // /**
    // //  * @Route("/category/delete/{id}", methods={"DELETE"}, name= "delete_by_id")
    // //  */ 
    // // public function delete ($id) {
    // // $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
    // // if ($category == null) {
    // //     $error = "ERROR: Category ID is invalid";
    // //     return new Response (
    // //         $error,
    // //         Response::HTTP_NO_CONTENT,   // 204              
    // //     );
    // // }
    // //     else {
    // //         $manager = $this->getDoctrine()->getManager();
    // //         $manager->remove($category);
    // //         $manager->flush();  // Thêm sửa xóa đều phải gọi đến flush
    // //         return new Response (   // Chạy đến đây là đã xóa thành công nhưng vẫn có thể xảy ra lỗi
    // //             "",
    // //             Response::HTTP_OK,      // 200         
    // //         );
    // //     }   
    // // }    
}
