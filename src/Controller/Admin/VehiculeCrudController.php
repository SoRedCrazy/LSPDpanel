<?php

namespace App\Controller\Admin;

use App\Entity\Vehicule;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class VehiculeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vehicule::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('immatriculation'),
            TextField::new('modele'),
            TextField::new('couleur'),
            DateField::new('Atcreate')->onlyOnIndex(),
            DateField::new('dateModif')->onlyOnIndex(),
            AssociationField::new('proprietaire')->setCrudController(CitoyenCrudController::class)->hideWhenUpdating(),
            AssociationField::new('agent')->setCrudController(AgentCrudController::class)->onlyOnIndex(),
            
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
