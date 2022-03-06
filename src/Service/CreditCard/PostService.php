<?php

namespace App\Service\CreditCard;

use App\Entity\CreditCard;
use App\Manager\CreditCard\PostManager;

class PostService
{
    public function __construct(private PostManager $postManager)
    {
    }

    public function post(array $user): CreditCard
    {
        return $this->postManager->post($user);

    }

}