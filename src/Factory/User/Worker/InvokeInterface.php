<?php



namespace App\Factory\User\Worker;

interface InvokeInterface
{
    public function __invoke(string $fileName);
}
