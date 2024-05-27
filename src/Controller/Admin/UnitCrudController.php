<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use GlobalEmergency\Apuntate\Entity\Unit;

class UnitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Unit::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('identifier'),
            AssociationField::new('speciality'),
            AssociationField::new('unitComponents'),
        ];
    }
}
