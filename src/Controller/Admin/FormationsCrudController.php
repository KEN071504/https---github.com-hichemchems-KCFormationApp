<?php

namespace App\Controller\Admin;

use App\Entity\Formations;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formations::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Intitule'),
            TextField::new('Diplome'),
            TextField::new('Descriptif'),
            DateField::new('DateSession'),
            TextField::new('Financement'),
            TextField::new('Type'),
        ];
    }
    
}
