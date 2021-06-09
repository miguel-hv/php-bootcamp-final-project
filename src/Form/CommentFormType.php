<?php


namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use \Symfony\Component\Form\AbstractType;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        parent::buildForm($builder, $options);
        $builder->add('name');
        $builder->add('title');
        $builder->add(
            'text',
            TextareaType::class,
        ['help'=>"Máximo 500 caracteres"]);
    }
}