<?php
/**
 * Created by PhpStorm.
 * User: dcurtet
 * Date: 04/07/2017
 * Time: 13:37
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use AppBundle\Enum\LicenceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;



/**
 * Class UserType
 * @package AppBundle\Form\Type
 */
class UserType extends AbstractType
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
            ->add('birthdate', TextType::class, [
                'label' => 'loc.form.birthdate',
                'translation_domain' => 'messages',
                // si BirthdateType mais cause un pb d'affichage dans easyadmin
                //'widget' => 'single_text',
                //'format' => 'dd-MM-yyyy'
            ])
            ->add('address', TextType::class, [
                'label' => 'loc.form.address',
                'translation_domain' => 'messages'
            ])
            ->add('zipcode', IntegerType::class, [
                'label' => 'loc.form.zipcode',
                'translation_domain' => 'messages'
            ])
            ->add('city', TextType::class, [
                'label' => 'loc.form.city',
                'translation_domain' => 'messages'
            ])
            ->add('email', EmailType::class, [
                'label' => 'loc.form.email',
                'translation_domain' => 'messages'
            ])
            ->add('phone', IntegerType::class, [
                'label' => 'loc.form.phone',
                'translation_domain' => 'messages'
            ])
            ->add('license', ChoiceType::class, [
                'label' => 'loc.form.license',
                'translation_domain' => 'messages',
                'choices' => LicenceType::getFormValues()
            ])
            ->add('justificatory_filename', FileType::class, [
                'label' => 'loc.form.justificatory_filename',
                'mapped' => false
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
