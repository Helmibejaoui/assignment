<?php

namespace App\Manager\CreditCard;

use App\Entity\CreditCard;
use Doctrine\ORM\EntityManagerInterface;

class PostManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function post(array $user): CreditCard
    {
        $entity = new CreditCard();
        $entity->setName($this->checkForType($user['credit_card']['name']));
        $entity->setExpirationDate($this->checkForType($user['credit_card']['expirationDate']));
        $entity->setNumber($this->checkForType($user['credit_card']['number']));
        $entity->setType($this->checkForType($user['credit_card']['type']));

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function checkForType($param)
    {
        return gettype($param) === 'array' ? null : $param;
    }
}