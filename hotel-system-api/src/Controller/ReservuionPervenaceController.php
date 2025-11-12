<?php

namespace App\Controller;

use App\Entity\Acompte as ReservuionPervenace;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReservuionPervenaceController extends AbstractController
{
    #[Route('/api/acomptes', name: 'create_acompte', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $acompte = new ReservuionPervenace();
        $acompte->setReservation($em->getReference('App\Entity\Reservation', $data['reservation_id']));
        $acompte->setMontant($data['montant']);
        $acompte->setMethode($data['methode']);
        $acompte->setStatut($data['statut'] ?? 'Validé');

        $em->persist($acompte);
        $em->flush();

        return $this->json($acompte, 201);
    }
}