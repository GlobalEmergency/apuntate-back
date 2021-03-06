<?php

namespace App\Controller\Admin;

use App\Entity\UnitComponent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class UnitComponentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UnitComponent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('unit'),
            AssociationField::new('component'),
            IntegerField::new('quantity'),

//            IdField::new('id'),
//            TextField::new('title'),
//            TextEditorField::new('description'),
        ];
    }
}
