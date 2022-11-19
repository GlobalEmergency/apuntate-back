<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use GlobalEmergency\Apuntate\Entity\UserSpeciality;

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
