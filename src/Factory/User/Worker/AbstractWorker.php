<?php



namespace App\Factory\User\Worker;

abstract class AbstractWorker implements WorkerInterface
{
    public static function getPriority(): int
    {
        return 1;
    }

    public function __invoke(string $fileName)
    {
    }

    public function supports(): bool
    {
    }
}
