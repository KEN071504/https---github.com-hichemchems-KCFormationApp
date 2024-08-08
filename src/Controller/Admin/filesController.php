<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class filesController extends AbstractController
{
    public function showFiles(): Response
    {
        $files = $this->entityManager->getRepository(User::class)->findAll();

        return $this->render('files.html.twig', [
            'files' => $files,
        ]);
        
    }




    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // public static function getEntityFqcn(): string
    // {
    //     CourDocumentManagerController::class;
    // }

    public function configureFields(string $pageName): iterable
    {
        $fileFieldOptions = [
            'required' => false,
            'allow_delete' => true,
            'download_uri' => false,
        ];
    
        return [
            // IdField::new('id'),
            TextField::new('leconsName', 'Leçon'),
            TextField::new('devoirsName', 'Devoir'),
            TextField::new('deposerName', 'Déposer'),
            TextField::new('aideAuxDevoirsName', 'Aide aux devoirs'),
            TextField::new('messagesName', 'Messages'),
    
            // File fields
            Field::new('leconsFile', 'Leçon')
                ->setFormType(VichFileType::class)
                ->setFormTypeOptions($fileFieldOptions),
            Field::new('devoirsFile', 'Devoir')
                ->setFormType(VichFileType::class)
                ->setFormTypeOptions($fileFieldOptions),
            Field::new('deposerFile', 'Déposer')
                ->setFormType(VichFileType::class)
                ->setFormTypeOptions($fileFieldOptions),
            Field::new('aideAuxDevoirsFile', 'Aide aux devoirs')
                ->setFormType(VichFileType::class)
                ->setFormTypeOptions($fileFieldOptions),
            Field::new('messagesFile', 'Messages')
                ->setFormType(VichFileType::class)
                ->setFormTypeOptions($fileFieldOptions),
    
            // Collection field
            CollectionField::new('files', 'Fichiers')
                ->setTemplatePath('files.html.twig')
                ->setEntryType(User::class)
                ->setFormTypeOptions($fileFieldOptions),
        ];
    }
}