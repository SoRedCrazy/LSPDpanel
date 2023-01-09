<?php

namespace App\Controller\Admin;

use App\Entity\Amende;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class AmendeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Amende::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('Agent')->setCrudController(AgentCrudController::class)->onlyOnIndex(),
            AssociationField::new('citoyen')->setCrudController(CitoyenCrudController::class)->hideWhenUpdating(),
            TextField::new('motif'),
            IntegerField::new('montant'),
            BooleanField::new('payer'),
            DateField::new('date')
            
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_SERGENT')
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }
    
}
