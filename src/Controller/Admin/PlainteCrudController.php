<?php

namespace App\Controller\Admin;

use App\Entity\Plainte;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class PlainteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plainte::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('date'),
            TextField::new('description'),
            ImageField::new('imageName', 'Image')
            ->hideOnForm()
            ->setBasePath('/images')
            ->setUploadDir('public/images'),
            Field::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            TextField::new('temoins'),
            AssociationField::new('citoyen')->setCrudController(CitoyenCrudController::class)->hideWhenUpdating(),
            AssociationField::new('accuser')->setCrudController(CitoyenCrudController::class)->hideWhenUpdating(),
            AssociationField::new('agent')->setCrudController(AgentCrudController::class)->onlyOnIndex(),
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
