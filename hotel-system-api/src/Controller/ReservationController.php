<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\ReservationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/api/reservations/custom', name: 'create_reservation', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $reservation = new Reservation();
        $reservation->setClient($em->getReference('App\Entity\Client', $data['client_id']));
        $reservation->setChambre($em->getReference('App\Entity\Chambre', $data['chambre_id']));
        $reservation->setDateDebut(new \DateTime($data['date_debut']));
        $reservation->setDateFin(new \DateTime($data['date_fin']));

        $em->persist($reservation);
        $em->flush();

        // Ajouter services
        if (!empty($data['services'])) {
            foreach ($data['services'] as $s) {
                $rs = new ReservationService();
                $rs->setReservation($reservation);
                $rs->setService($em->getReference('App\Entity\ServiceSupplementaire', $s['service_id']));
                $rs->setQuantite($s['quantite'] ?? 1);
                $em->persist($rs);
            }
            $em->flush();
        }

        // Trigger MySQL recalculera prix_total
        return $this->json($reservation, 201);
    }
}