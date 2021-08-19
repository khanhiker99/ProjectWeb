<?php

// namespace App\Security;

// use Symfony\Component\HttpFoundation\Request;

// use 


// public class AccessDeniedHandler implements AccessDeniedHandlerInterface 
// {
//     public function __construct(SessionInterface $session, RouterInterface $router) 
//     {
//         $this->session = $session;
//         $this->router = $router;
//     }

//     public function handler (Request $request, AccessDeniedException $accessDeniedException)
//     {
//         // show a warning message

//         $this->session->getFlashBag()->add('Warning', 'Unauthorized');


//         // redirect to "Login" page
//         return new RedirectResponse($this->router->generate('app_login'));

//     }
// }


// ?>
