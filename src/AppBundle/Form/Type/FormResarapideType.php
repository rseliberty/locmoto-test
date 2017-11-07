<?php
/**
 * Created by PhpStorm.
 * User: dcurtet
 * Date: 04/07/2017
 * Time: 13:37
 */

namespace AppBundle\Form\Type;

use AppBundle\Enum\DurationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Class FormResaType
 * @package AppBundle\Form\Type
 */
class FormResarapideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            //ajout du choix de la date lors de la préréservation avec jquery datepicker
            ->add('date', DateType::class, [
                'label' => 'loc.form.date',
                // par défaut required is true
                'translation_domain' => 'messages',
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy'
            ])
            //ajout du choix de la durée en selection
            ->add('duration', ChoiceType::class, [
                'label' => 'loc.form.duration',
                // par défaut required is true
                'translation_domain' => 'messages',
                'choices' => DurationType::getFormValues()
            ])

            //ajout de l'utilisateur qui est dans une autre entité user
            ->add('user', UserrapideType::class, [
                'data' => $options['user'],
                'label' => 'loc.form.user',
                'translation_domain' => 'messages'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user' => null
        ]);
    }

}
