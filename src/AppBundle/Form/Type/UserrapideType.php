<?php
/**
 * Created by PhpStorm.
 * User: dcurtet
 * Date: 04/07/2017
 * Time: 13:37
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



/**
 * Class UserType
 * @package AppBundle\Form\Type
 */
class UserrapideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...

            ->add('lastname', TextType::class, [
                'label' => 'loc.form.lastname',
                'translation_domain' => 'messages'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'loc.form.firstname',
                'translation_domain' => 'messages'
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'loc.form.submit',
                'translation_domain' => 'messages'
            ])
            // ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            //pour lier à une entité user
            'data_class' => User::class,
        ));
    }
}
