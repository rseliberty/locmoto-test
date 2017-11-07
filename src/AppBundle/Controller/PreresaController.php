<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RentMoto;
use AppBundle\Entity\Vehicle;
use AppBundle\Form\Type\FormResaType;
//utile pour spécifier la route au controleur
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\JustificatoryType;

class PreresaController extends Controller
{
    //Toutes les méthodes "Contrôleurs" se terminent par "Action" sous Symfony
    /**
     * @Route("/preresa", name="preresa")
     * obligation d'être connecté grâce au security.yml dans config
     */
    public function preresaAction(Request $request, Vehicle $vehicle)
    {
        // pour récupérer le user de la session  en cours
        $user = $this->getUser();
        // dans le cas où le gérant passe à actif un modèle alors qu'une prérésa est en cours pour un véhicule
        $prerent = $this->getDoctrine()->getRepository('AppBundle:RentMoto')->getRentActived($vehicle);
        $resdateForSameVehicle = $this->getDoctrine()->getRepository('AppBundle:RentMoto')->getDateDifferent($vehicle);
        // pour verifier si le user en cours a une prérésa active avec ce modèle
        // ou si le vehicule est disponible > éviter les risques de rentrer un modele dans l'url directement
        // ou si une pré-réservation active d'un user est en cours pour ce véhicule
        if($user->hasActiveRents() || !$vehicle->isAvailable() || $prerent == true ){
            return $this->render('AppBundle:Preresa:preresa.html.twig', ['user' => $user, 'vehicle'=> $vehicle, 'prerent' => $prerent ]);
        }
        else {
            //création du formulaire de pré-réservation
            $form = $this->createForm(FormResaType::class, null, ['user' => $user]);
            //pour matcher les valeurs postées avec le formulaire
            $form->handleRequest($request);
            // pour verifier si le formulaire est soumis et si le nombre d'erreurs est nul notamment not blank,...
            if ($form->isSubmitted() && $form->isValid()) {
                //pour accéder à la base de données
                $entityManager = $this->get('doctrine.orm.entity_manager');

                //passer à "non disponible" le vehicule et afficher un message indiquant la pré-réservation.
                $vehicle->setAvailable(false);
                //appel du service de traduction
                $translator = $this->get('translator');
                $vehicle->setComment($translator->trans('loc.form.end'));
                $duration = $form->get('duration')->getData();
                $resDate = $form->get('date')->getData();
                //création de l'objet pré-réservation
                $rent = new RentMoto();
                // passer les paramètres
                $rent
                    ->setUser($user)
                    ->setVehicle($vehicle)
                    ->setDuration($duration)
                    ->setDate($resDate);
                //persister un nouvel objet lors de la création
                $entityManager->persist($rent);
                // Enregistrer toutes les variables $vehicle, $rent et $user
                $entityManager->flush();
                // Ajout du flash message
                $request->getSession()
                    ->getFlashBag()
                    ->add('success', $translator->trans('loc.form.save.success'));
                // Send mail
                $message = (new \Swift_Message('Pré-réservation Locmoto ' . 'numéro ' . $rent->getId()))
                    ->setFrom('send@locmoto.com', 'send@locmoto.com')
                    ->setTo($rent->getUser()->getEmail())
                    ->setBody(
                        $this->renderView(
                            'AppBundle:Emails:reservation.html.twig',
                            [
                                'rent' => $rent
                            ]
                        ),
                        'text/html'
                    );
                // lancer en cmd  tail -f var/logs/dev.log| grep 'send' par exemple pour visualiser dans les logs le moment où le send mail est fait
                $this->get('logger')->debug('send mail ...');

                //envoi de l'email
                if ($this->get('swiftmailer.mailer')->send($message)) {
                    // Ajout du flash message
                    $request->getSession()
                        ->getFlashBag()
                        ->add('success', $translator->trans('loc.email.resa.success'));
                }
                else {
                    $request->getSession()
                        ->getFlashBag()
                        ->add('error', $translator->trans('loc.email.resa.error'));
                }
                // redirection vers la route "liste_vehicle"
                return $this->redirect($this->generateUrl('liste_vehicles'));
            }
            // pour retourner la page pré-réservation
            return $this->render('AppBundle:Preresa:preresarapide.html.twig', [
                //création du formulaire et de l'utilisateur
                'form' => $form->createView(),
                'user' => $user,
                //ajout des dates pré-réservées pr ce vehicule
                'vehicle'=> $vehicle,
                'daterent' => $resdateForSameVehicle

            ]);
        }
    }
}
