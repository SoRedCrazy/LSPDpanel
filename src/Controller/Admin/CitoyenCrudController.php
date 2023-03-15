<?php

namespace App\Controller\Admin;

use App\Entity\Amende;
use App\Entity\Citoyen;
use App\Entity\PeinePrison;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class CitoyenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Citoyen::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Username'),
            DateField::new('dateNaissance'),
            IntegerField::new('Num_Telephone'),
            TextField::new('sexe'),
            IntegerField::new('taille'),
            TextField::new('metier'),
            BooleanField::new('rechercher', 'Recherché'),
            ImageField::new('imageName', 'Image')
            ->hideOnForm()
            ->setBasePath('/avatar')
            ->setUploadDir('public/avatar'),
            Field::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            AssociationField::new('vehicules')->setCrudController(VehiculeCrudController::class)->hideOnForm(),
            AssociationField::new('amendes')->setCrudController(AmendeCrudController::class)->hideOnForm(),
            AssociationField::new('volVehicules')->setCrudController(VolVehiculeCrudController::class)->hideOnForm(),
            AssociationField::new('peinePrisons')->setCrudController(PeinePrisonCrudController::class)->hideOnForm(),
            AssociationField::new('plaintes')->setCrudController(PlainteCrudController::class)->hideOnForm(),
            AssociationField::new('vols')->setCrudController(VolCrudController::class)->hideOnForm(),
            AssociationField::new('armes')->setCrudController(VolCrudController::class)->hideOnForm(),

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
