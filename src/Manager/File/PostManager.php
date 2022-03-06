<?php

namespace App\Manager\File;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;

class PostManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function post(array $file): bool
    {
        $entity = new File();
        $entity->setName($file['name']);
        $entity->setSize($file['size']);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return true;
    }

}