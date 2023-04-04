<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('Deamande de contact')
        ->setEntityLabelInPlural("Demandes de contact")


        ->setPageTitle("index", "Laxar - Administration des demandes de contact")

        ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnIndex(),
        TextField::new('email')
            ->setFormTypeOption('disabled', 'disabled'),
        TextField::new('lastname'),
        TextField::new('name')
        ->hideOnForm(),
        TextField::new('subject')
        ->setFormTypeOption('disabled', 'disabled'),
        TextareaField::new('message')
        ->setFormTypeOption('disabled', 'disabled'),
        DateField::new('createdAt')
            ->hideOnForm()
            ->setFormTypeOption('disabled', 'disabled'),

        ];
    }

}
