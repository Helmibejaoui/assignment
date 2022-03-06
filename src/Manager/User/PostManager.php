<?php

namespace App\Manager\User;

use App\Entity\File;
use App\Entity\User;
use App\Service\CreditCard\PostService as CreditCardPostService;
use App\Service\File\PutService as FilePutService;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;


class PostManager
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private CreditCardPostService  $postService,
                                private FilePutService         $putService)
    {
    }

    public function post(array $user, File $file, int $key): bool
    {
        $this->putService->put($file, $key);
        $date = $this->checkForType($user['date_of_birth']) ? (@str_contains($user['date_of_birth'], "/") ? date_create_from_format('d/m/Y', $user['date_of_birth']) : new DateTime($user['date_of_birth'])) : null;

        if ($date === null || ($date->diff(new DateTime())->y >= 18 && $date->diff(new DateTime())->y <= 65)) {
            $creditCard = $this->postService->post($user);
            $entity = new User();
            $entity->setName($this->checkForType($user['name']));
            $entity->setEmail($this->checkForType($user['email']));
            $entity->setAddress($this->checkForType($user['address']));
            $entity->setAccount($this->checkForType($user['account']));
            $entity->setChecked($this->checkForType($user['checked']));
            $entity->setDateOfBirth($date);
            $entity->setDescription($this->checkForType($user['name']));
            $entity->setInterest($this->checkForType($user['interest']));
            $entity->setCreditCard($creditCard);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            return true;
        }


        return true;
    }

    public function checkForType($param)
    {
        return gettype($param) === 'array' ? null : $param;
    }
}