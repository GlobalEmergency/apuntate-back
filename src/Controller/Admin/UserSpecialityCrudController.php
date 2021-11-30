<?php

namespace App\Controller\Admin;

use App\Entity\UserSpeciality;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class UserSpecialityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserSpeciality::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user'),
            AssociationField::new('speciality'),
            DateField::new('dateStart'),
            DateField::new('dateEnd'),
        ];
    }
}
