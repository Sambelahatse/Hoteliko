<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ClientController extends AbstractController
{
    #[Route('/api/clients', name: 'create_client', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $client = new Client();
        $client->setNom($data['nom'] ?? '');
        $client->setPrenom($data['prenom'] ?? '');
        $client->setEmail($data['email'] ?? null);
        $client->setTelephone($data['telephone'] ?? null);
        $client->setAdresse($data['adresse'] ?? null);

        $errors = $validator->validate($client);
        if (count($errors) > 0) {
            return $this->json(['errors' => (string) $errors], 400);
        }

        $em->persist($client);
        $em->flush();

        return $this->json($client, 201, [], ['groups' => 'client:read']);
    }

    #[Route('/api/clients/{id}', name: 'update_client', methods: ['PUT'])]
    public function update(Client $client, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $data = json_decode($request->getContent(), true);

        $client->setNom($data['nom'] ?? $client->getNom());
        $client->setPrenom($data['prenom'] ?? $client->getPrenom());
        $client->setEmail($data['email'] ?? $client->getEmail());
        $client->setTelephone($data['telephone'] ?? $client->getTelephone());
        $client->setAdresse($data['adresse'] ?? $client->getAdresse());

        $errors = $validator->validate($client);
        if (count($errors) > 0) {
            return $this->json(['errors' => (string) $errors], 400);
        }

        $em->flush();

        return $this->json($client, 200, [], ['groups' => 'client:read']);
    }
}