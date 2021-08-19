<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Form\CartType;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//#[Route('/cart')]
class CartController extends AbstractController
{
     /**
     * @Route("/cart", name="cart_index")
     */
    public function indexCart() 
    {
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findAll();

        return $this->render(
            'cart/index.html.twig',
            [
                'cart' => $cart
            ]
        );
    }

    /**
     * @Route("/cart/detail/{id}", name="cart_detail")
     */
    public function detailCart($id) {
        $cart = $this->getDoctrine()->getRepository(Cart::class)->find($id);

        return $this->render(
            'cart/detail.html.twig',
            [
                'cart' => $cart
            ]
        );
    }

    // /**
    //  * @Route("/cart/delete/{id}", name="cart_delete")
    //  */
    // public function deleteCart($id) {
    //     $cart = $this->getDoctrine()->getRepository(Cart::class)->find($id);

    //     if ($cart == null) {
    //         $this->addFlash("Error", "Delete category failed !");
    //         return $this->redirectToRoute("cart_index");
    //     }

    //     $manager = $this->getDoctrine()->getManager();
    //     $manager->remove($cart);
    //     $manager->flush();

    //     $this->addFlash("Info","Delete category succeed !");
    //     return $this->redirectToRoute("cart_index");
    // }

    // /**
    //  * @Route("cart/create", name="cart_create")
    //  */
    // public function createCart(Request $request) {
    //     $cart = new Cart();
    //     $form = $this->createForm(CategoryType::class,$cart);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $manager = $this->getDoctrine()->getManager();
    //         $manager->persist($cart);
    //         $manager->flush();

    //         $this->addFlash("Info", "Create category succeed !");
    //         return $this->redirectToRoute("cart_index"); 
    //     }

    //     return $this->render(
    //         'cart/create.html.twig',
    //         [
    //             'form' => $form->createView()
    //         ]
    //     );
    // }

    // /**
    //  * @Route("cart/update/{id}", name="cart_update")
    //  */
    // public function updateCart(Request $request, $id) {
    //     $cart = $this->getDoctrine()->getRepository(Cart::class)->find($id);
    //     $form = $this->createForm(CartType::class,$cart);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $manager = $this->getDoctrine()->getManager();
    //         $manager->persist($cart);
    //         $manager->flush();

    //         $this->addFlash("Info", "Update category succeed !");
    //         return $this->redirectToRoute("cart_index"); 
    //     }

    //     return $this->render(
    //         'cart/update.html.twig',
    //         [
    //             'form' => $form->createView()
    //         ]
    //     );
    }

























    // #[Route('/', name: 'cart_index', methods: ['GET'])]
    // public function index(CartRepository $cartRepository): Response
    // {
    //     return $this->render('cart/index.html.twig', [
    //         'carts' => $cartRepository->findAll(),
    //     ]);
    // }

    // #[Route('/create', name: 'cart_create', methods: ['GET', 'POST'])]
    // public function new(Request $request): Response
    // {
    //     $cart = new Cart();
    //     $form = $this->createForm(CartType::class, $cart);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($cart);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('cart_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('cart/create.html.twig', [
    //         'cart' => $cart,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'cart_show', methods: ['GET'])]
    // public function show(Cart $cart): Response
    // {
    //     return $this->render('cart/show.html.twig', [
    //         'cart' => $cart,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'cart_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Cart $cart): Response
    // {
    //     $form = $this->createForm(CartType::class, $cart);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('cart_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('cart/edit.html.twig', [
    //         'cart' => $cart,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'cart_delete', methods: ['POST'])]
    // public function delete(Request $request, Cart $cart): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$cart->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($cart);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('cart_index', [], Response::HTTP_SEE_OTHER);
    // }
// }