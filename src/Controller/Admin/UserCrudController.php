<?php

namespace App\Controller\Admin;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Routing\Annotation\Route;


class UserCrudController extends AbstractCrudController
{
   
    public static function getEntityFqcn(): string
    {
       

        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
{
    $roles = [
        'ADMIN' => 'Admin',
        'FORMATEUR' => 'Formateur',
        'APPRENANT' => 'Apprenant',
        'CLIENT' => 'Client',
    ];

    $qualites = [
        'M.' => 'M.',
        'Mme' => 'Mme',
    ];
    
    if ($pageName === 'new') {
    return [
        ChoiceField::new('roles')
            ->setChoices($roles)
            ->allowMultipleChoices(true)
            ->setHelp('Sélectionnez les rôles pour cet utilisateur'),
        ChoiceField::new('qualite')
            ->setChoices($qualites)
            ->setHelp('Sélectionnez la qualité pour cet utilisateur'),
        TextField::new('nom'),
        TextField::new('prenom'),
        TextField::new('email'),
        TextField::new('password'),
        IntegerField::new('idFormation'),
        Field::new('document') // Note: le nom du champ doit être en minuscule
            ->setFormType(VichFileType::class)
            ->setFormTypeOptions([
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                ]),
        TextEditorField::new('description'),
                    ];}
                    else {
                        return [
                            //IdField::new('id'),
                            TextField::new('email'),
                            TextField::new('nom'),
                            TextField::new('prenom'),
                            TextField::new('password'),
                            ChoiceField::new('roles')
                                ->setChoices($roles)
                                ->allowMultipleChoices(true),
                            ChoiceField::new('qualite'),
                            IntegerField::new('idFormation'),
                            TextField::new('qualite'),
                            Field::new('Document') // Note: le nom du champ doit être en minuscule
                                ->setFormType(VichFileType::class)
                                ->setFormTypeOptions([
                                    'required' => false,
                                    'allow_delete' => true,
                                    'download_uri' => true,
                            ]),
                            TextEditorField::new('description'),
                        ];
                    }
                }
            }