<?php

namespace App\Controller\Admin;

use App\Entity\Speciality;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SpecialityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Speciality::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
