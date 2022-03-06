<?php

namespace App\MessageHandler;

use App\Message\ProcessNotification;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Process\Process;

#[AsMessageHandler]
class ProcessNotificationHandler
{
    public function __construct(private KernelInterface $kernel)
    {
    }

    public function __invoke(ProcessNotification $message)
    {
        $process = new Process(['php', 'bin/console', 'app:user', "--file={$message->getFile()['name']}"]);
        $process->setWorkingDirectory($this->kernel->getProjectDir());
        $process->setTimeout(null);
        $process->setIdleTimeout(null);
        $process->run();
    }
}