<?php

namespace App\Controller\Admin;

use App\Entity\PeinePrison;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class PeinePrisonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PeinePrison::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('motif'),
            IntegerField::new('temps'),
            DateField::new('date'),
            BooleanField::new('etat'),
            AssociationField::new('agent')->setCrudController(AgentCrudController::class)->onlyOnIndex(),
            AssociationField::new('citoyen')->setCrudController(CitoyenCrudController::class)->hideWhenUpdating(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_LIEUTENANT')
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }    
}
