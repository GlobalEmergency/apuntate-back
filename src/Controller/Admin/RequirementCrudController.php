<?php

namespace App\Controller\Admin;

use App\Entity\Requirement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RequirementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Requirement::class;
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
