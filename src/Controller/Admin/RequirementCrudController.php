<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use GlobalEmergency\Apuntate\Entity\Requirement;

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
