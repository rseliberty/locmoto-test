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


/**
 * Class FormResaType
 * @package AppBundle\Form\Type
 */
class FormResaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            //ajout du choix de la date lors de la préréservation
            ->add('date', DateType::class, [
                'label' => 'loc.form.date',
                // par défaut required is true
                'translation_domain' => 'messages',
                'widget' => 'single_text',
                // afin de prendre des valeurs anterieures de 80 ans dans le cas de choice au lieu de single_text
                // vient surcharger la valeur par defaut de $resolver dans DateType dans le cas où widget est "choice"
                //'years' => range(date('Y') - 80, date('Y') + 5),
                //si affichage date du jour simple
                //'data' => new \DateTime('+1hour'),
                //avec datepicker
                'input' => 'datetime',
                // majuscules pour distinguer les heures matin/après-midi
                //'format' => 'dd/MM/yyyy HH:mm'
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
            ->add('user', UserType::class, [
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
