<?php

namespace App\Command;

use App\Factory\User\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:user';
    protected static $defaultDescription = 'insert users out of file';

    public function __construct(private Factory $factory)
    {
        parent::__construct(self::$defaultName);
    }

    protected function configure(): void
    {
        $this->setDescription(self::$defaultDescription)
            ->addOption('file', null,InputArgument::OPTIONAL, 'file name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fileName=$input->getOption('file');
        $this->factory->run($fileName);

        return 1;
    }
}