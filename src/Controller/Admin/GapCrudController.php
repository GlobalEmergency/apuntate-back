<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use GlobalEmergency\Apuntate\Entity\Gap;

class GapCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gap::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user'),
            AssociationField::new('service'),
            AssociationField::new('unitComponent'),
        ];
    }
}
