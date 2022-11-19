<?php

namespace GlobalEmergency\Apuntate\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use GlobalEmergency\Apuntate\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class UserCrudController extends AbstractCrudController
{
    private Security $security;
    private UserPasswordHasherInterface $passwordEncoder;
    private ?string $password;

    public function __construct(
        UserPasswordHasherInterface $passwordEncoder,
        Security $security
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->security = $security;

        // get the user id from the logged in user
        if (null !== $this->security->getUser()) {
            $this->password = $this->security->getUser()->getPassword();
        }
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('surname'),
            TextField::new('email'),
            TextField::new('password')->setFormType(PasswordType::class)->setRequired(false),
            DateField::new('dateStart'),
            DateField::new('dateEnd'),
            ChoiceField::new('roles')->setChoices([
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                'ROLE_USER' => 'ROLE_USER',
            ])->autocomplete()->allowMultipleChoices(),
            AssociationField::new('requirements'),
//            TextEditorField::new('description'),
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // set new password with encoder interface
        if (method_exists($entityInstance, 'setPassword')) {
            $clearPassword = trim($this->get('request_stack')->getCurrentRequest()->request->all('User')['password']);

            // if user password not change save the old one
            if (true === isset($clearPassword) && '' === $clearPassword) {
                // $entityInstance->setPassword($this->password);
            } else {
                $encodedPassword = $this->passwordEncoder->hashPassword($entityInstance, $clearPassword);
                $entityInstance->setPassword($encodedPassword);
            }
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
}
