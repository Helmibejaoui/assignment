<?php

namespace App\Manager\File;

use App\Entity\File;
use App\Entity\User;
use App\Service\CreditCard\PostService;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class PutManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function put(File $file, int $line): bool
    {
        $file->setLastLine($line);
        $this->entityManager->persist($file);
        $this->entityManager->flush();

        return true;
    }

}