<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use GlobalEmergency\Apuntate\Entity\Service;
use GlobalEmergency\Apuntate\Entity\ServiceStatus;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $status = ChoiceField::new('status');
        $choices = [];
        foreach (ServiceStatus::cases() as $key => $choice) {
            $choices[$choice->value] = $choice->value;
        }
        $status->setChoices($choices);
        //        $status->setFormTypeOptions([
        //
        //            'choice_value' => function (?ServiceStatus $entity = null) {
        //                return $entity?->value;
        //            },
        //            'choice_label' => function (?ServiceStatus $entity = null) {
        //                return $entity?->name;
        //            },
        //            'data_class' => null,
        //            'multiple' => false,
        //            'expanded' => false,
        //        ])
        $status->setFormTypeOption('setter', function (Service $entity, ?string $value): void {
            if (null == ServiceStatus::tryFrom($value)) {
                return;
            }
            $entity->setStatus(ServiceStatus::tryFrom($value)->value);
        });

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
