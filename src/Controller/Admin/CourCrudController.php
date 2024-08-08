<?php

namespace App\Controller\Admin;

use App\Entity\Cour;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class CourCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cour::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $commonFileOptions = [
            'required' => false,
            'allow_delete' => true,
            'download_uri' => true,
        ];

        return [
            IdField::new('id'),
            Field::new('leconsFile', 'Lecon')
                ->setFormType(VichFileType::class)
                ->setFormTypeOptions($commonFileOptions),
            Field::new('devoirsFile', 'Devoir')
                ->setFormType(VichFileType::class)
                ->setFormTypeOptions($commonFileOptions),
            ImageField::new('imageFile', 'Image')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions($commonFileOptions),
            CollectionField::new('files', 'Fichiers')
                ->setTemplatePath('/cour/files/{filename}')
                ->setEntryType(VichFileType::class)
                ->setFormTypeOptions($commonFileOptions),
        ];
    }
}