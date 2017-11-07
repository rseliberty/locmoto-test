<?php

namespace AppBundle\Command;

use AppBundle\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TestVehicleCommand
 * @package AppBundle\Command
 * Pr tester rajouter d'abord @Assert\NotBlank() au dessus de l'id dans la classe Vehicle
 * > permet de tester que les contraintes d'assertion (champs non vide (NotBlank)) sont respectées
 * Dans le terminal lancer sf locmoto:test:vehicle
 */
class TestVehicleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('locmoto:test:vehicle')
            ->setDescription('Test class vehicle');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Test de la classe vehicle...');

        $vehicle = new Vehicle();

        // Utilisation du validator de Symfony (https://symfony.com/doc/current/components/validator.html)
        // pour valider les valeurs d'une entité avec les annotations Symfony\Component\Validator\Constraints
        $validator = $this->getContainer()->get('validator');
        $errors = $validator->validate($vehicle);

        if (count($errors) > 0) {
            $output->writeln((string) $errors);
        }
    }
}
