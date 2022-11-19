<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use GlobalEmergency\Apuntate\Entity\Entity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EntityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Entity::class;
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
