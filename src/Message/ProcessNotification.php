<?php

namespace App\Message;

class ProcessNotification
{
    private array $file;

    public function __construct(array $file)
    {
        $this->file = $file;
    }

    public function getFile(): array
    {
        return $this->file;
    }
}