<?php

namespace App\Controller\Admin;

use App\Entity\Rapport;
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

class RapportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rapport::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('description'),
            ImageField::new('imageName', 'Image')
            ->hideOnForm()
            ->setBasePath('/images')
            ->setUploadDir('public/images'),
            Field::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            TextField::new('temoins'),
            DateField::new('date'),
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
