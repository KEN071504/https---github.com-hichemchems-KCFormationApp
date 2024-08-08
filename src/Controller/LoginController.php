<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if (!$this->getUser()) { // <--- Add this check
            $error = $authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();
    
            return $this->render('security/login.html.twig', [
                'last_username' => $lastUsername,
                'error' => $error,
            ]);
        }
    
        $user = $this->getUser();
        $roles = $user->getRoles();
    
        if (in_array('ROLE_CLIENT', $roles)) {
            return $this->redirectToRoute('app_dashboard_client');
        } elseif (in_array('ROLE_APPRENANT', $roles)) {
            return $this->redirectToRoute('app_dashboard_apprenant');
        } elseif (in_array('ROLE_FORMATEUR', $roles)) {
            return $this->redirectToRoute('app_dashboard_formateur');
        }
    
    
            $error = $authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();
    
            return $this->render('security/login.html.twig', [
                'last_username' => $lastUsername,
                'error' => $error,
            ]);
        }
    
        #[Route(path: '/logout', name: 'app_logout')]
        public function logout()
        {
            return $this->redirectToRoute('app_login');// Do nothing, let Symfony handle the logout
        }
    }