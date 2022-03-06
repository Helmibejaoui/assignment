<?php

namespace App\Service\File;

use App\Entity\File;
use App\Manager\File\PostManager;
use Doctrine\ORM\EntityManagerInterface;

class PostService
{
    public function __construct(private PostManager $postManager, private EntityManagerInterface $entityManager)
    {
    }

    public function post(array $file): bool
    {
        $entity = $this->entityManager->getRepository(File::class)->findOneBy(array('name' => $file['name']));
        if (!$entity) {
            return $this->postManager->post($file);
        }

        return true;
    }

}