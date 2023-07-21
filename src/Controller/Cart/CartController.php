<?php

namespace App\Controller\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route("/cart", name: "cart")]
    public function __invoke(SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        return $this->render('cart/cart.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route("/delete-cart", name: "delete_cart")]
    public function deleteCart(SessionInterface $session): Response
    {
        $session->remove('cart');

        return $this->redirectToRoute('cart');
    }
}