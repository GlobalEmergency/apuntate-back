<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use GlobalEmergency\Apuntate\Entity\Entity;

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
