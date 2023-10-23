<?php

namespace App\Controller\Admin;

use App\Entity\Agent;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};
use EasyCorp\Bundle\EasyAdminBundle\Field\{ArrayField, BooleanField, Field, IdField, TextField};
use Symfony\Component\Form\Extension\Core\Type\{PasswordType, RepeatedType};
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;


class AgentCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Agent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('username'),
            IntegerField::new('matricule'),
            IntegerField::new('Num_telephone'),
            BooleanField::new('actif'),
            ArrayField::new('roles'),
            Field::new('Password', 'New Password')->onlyOnForms()
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                   'type' => PasswordType::class,
                   'first_options' => ['label' => 'New password'],
                   'second_options' => ['label' => 'Repeat Password']
            ])->setRequired(true)
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms(),
            ImageField::new('imageName', 'Image')
            ->hideOnForm()
            ->setBasePath('/avatar')
            ->setUploadDir('public/avatar')
            ->setFormTypeOptions(['required' => true]),
            Field::new('imageFile','Image')->setFormType(VichImageType::class)->onlyOnForms()->setFormTypeOptions(['required' => true]),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
        ;
    }

}
