<?php


namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;
use \Symfony\Component\Form\AbstractType;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        parent::buildForm($builder, $options);
        $builder->add('name');
        $builder->add('email');
        $builder->add('password');
//        $builder->add('image', UrlType::class);


    }
}