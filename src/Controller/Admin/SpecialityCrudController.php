<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use GlobalEmergency\Apuntate\Entity\Speciality;

class SpecialityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Speciality::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //            IdField::new('id'),
            TextField::new('name'),
            TextField::new('abbreviation'),

            //            TextEditorField::new('description'),
        ];
    }
}
