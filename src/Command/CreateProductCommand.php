<?php

namespace App\Command;

use Symfony\Component\Console\Atrribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/* 
    We create a command in the console with the name "app:create-product"

    We shouln't write logics here like controller and we should use a service
    to do this. and then inject it in the command.
*/

#[AsCommand(name: 'app:create-product', description: 'Create a new product')]
class CreateProductCommand extends Command
{

    protected static $defaultName = 'app:create-product'; // we access to the name of command

    protected function configure()
    {
        // we have addArgument when we execute the Command
        $this->addArgument('title', InputArgument::REQUIRED);
        $this->addArgument('stock', InputArgument::REQUIRED);
        // order of arguments is important
    }

    // execute must return int
    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        $input->getArgument();

        $output->writeln('Clog from command in src/Command/CreateProductCommand.php');
        return self::SUCCESS; // return 0
    }
}