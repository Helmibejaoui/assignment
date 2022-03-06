<?php

namespace App\Service\File;

use App\Entity\File;
use App\Manager\File\PutManager;

class PutService
{
    public function __construct(private PutManager $postManager)
    {
    }

    public function put(File $file,int $key): bool
    {
        return $this->postManager->put($file,$key);

    }

}