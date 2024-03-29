<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use GlobalEmergency\Apuntate\Entity\Service;
use GlobalEmergency\Apuntate\Type\ServiceStatusType;

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

            AssociationField::new('units'),
        ];
    }
}
