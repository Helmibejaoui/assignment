<?php

namespace App\Service\User;

use App\Entity\File;
use App\Manager\User\PostManager;

class PostService
{
    public function __construct(private PostManager $postManager)
    {
    }

    public function post(array $user,File $file,int $key): bool
    {
        return $this->postManager->post($user,$file,$key);

    }

}