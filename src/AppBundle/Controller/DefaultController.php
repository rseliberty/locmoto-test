<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Vehicle;
//utile pour spécifier la route au controleur
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{


    //Toutes les méthodes "Contrôleurs" se terminent par "Action" sous Symfony
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * pour retourner la page d'accueil avec les véhicules
     */
    public function vehiclesAction(Request $request)
    {
        $vehicles = $this->getDoctrine()->getRepository('AppBundle:Vehicle')->findAll();

        return $this->render(
            'AppBundle:Default:index.html.twig',
            [
                //tous les paramètres consommés par la vue
                //la clé 'vehicles' peut être renommée en 'models' par exemple
                'vehicles' => $vehicles
                // la clé du tableau est "vehicles" et sera la variable twig dans index.html.twig

            ]
        );

    }

    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return \Symfony\Component\HttpFoundation\Response
     * pour retourner la page de selection du véhicule
     */
    public function selectionAction(Request $request, Vehicle $vehicle)
    {
        return $this->render(
            'AppBundle:Default:selection.html.twig',
            [
                'selection' => $vehicle
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * pour visualiser la page de selection du filtre
     */
    public function filterAction(Request $request)
    {
        $selection = $request->query->get('selection') ;
        // rediriger vers la page dont la route est selection et la variable sera le modèle
        return $this->redirectToRoute('loc_select_moto', ['model'=>$selection]);

    }
}
