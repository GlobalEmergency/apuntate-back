<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use App\Type\ServiceStatusType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $status = ChoiceField::new('status');
        $status->setChoices(ServiceStatusType::getValues());

        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            DateTimeField::new('datePlace'),
            DateTimeField::new('dateStart'),
            DateTimeField::new('dateEnd'),

            $status,

            AssociationField::new('units')
        ];
    }
}
