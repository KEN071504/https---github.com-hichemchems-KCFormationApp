<?php

namespace App\Controller\Admin;


use App\Entity\User;
use App\Entity\Cour;
use App\Entity\Formations;
use App\Controller\Admin\UserCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\CourCrudController;


class DashboardController extends AbstractDashboardController
{
    private SecurityBundleSecurity $security;
    private AdminUrlGenerator $adminUrlGenerator;
    const FILES_ACTION = 'files';


    public function __construct(SecurityBundleSecurity $security, AdminUrlGenerator $adminUrlGenerator)
    {
        $this->security = $security;
        $this->adminUrlGenerator = $adminUrlGenerator;  
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $user = $this->security->getUser();
        if (null === $user) {
            // Handle the case where the user is not logged in
            // For example, you can redirect them to the login page
            return $this->redirectToRoute('app_login');
        }
        $roles = $user->getRoles();

        if (empty($roles)) {
            // Handle the case where the user has no roles
            // For example, you can display an error message
            return $this->render('admin/dashboard.html.twig', [
                'error' => 'You have no roles assigned to you.',
            ]);
        }
    
        $role = $roles[0];
    
        switch ($role) {
            case 'ROLE_ADMIN':
                $url = $this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl();
                return $this->redirect($url);
                break;
            case 'ROLE_CLIENT':
                // Afficher le contenu pour le client
                break;
            case 'ROLE_FORMATEUR':
                // Afficher le contenu pour le formateur
                break;
            case 'ROLE_APPRENANT':
                // Afficher le contenu pour l'apprenant
                break;
            default:
                // Gestion du cas où le rôle n'est pas reconnu
                return $this->render('admin/dashboard.html.twig', [
                    'role' => $role,
                ]);
        }

        return $this->render('admin/dashboard.html.twig', [
            'role' => $role,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('KCFormationApp');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Formations', 'fa fa-home', Formations::class);
        yield MenuItem::linkToCrud('Cours', 'fa fa-person-chalkboard', Cour::class);
        yield MenuItem::linkToRoute('Retour à l\'accueil', 'fa fa-home', 'app_home');
        yield MenuItem::linkToRoute('Déconnexion', 'fa fa-sign-out', 'app_logout');
        yield MenuItem::linkToCrud('Fichiers', 'fa fa-file', Cour::class, self::FILES_ACTION);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}