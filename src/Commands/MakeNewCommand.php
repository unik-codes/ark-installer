<?php

namespace UnikCodes\Console\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnikCodes\Console\Commander;

class MakeNewCommand extends Commander
{
    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this
            ->setName('new')
            ->setDescription('Create a new Ark project')
            ->addArgument('name', InputArgument::REQUIRED, 'Project name')
            ->addArgument('path', InputArgument::OPTIONAL, 'Path of the project to be create');
    }

    /**
     * Execute the command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Your ' . $input->getArgument('name') . ' is ready!</info>');
        $output->writeln('<comment>Thank you for using Ark!</comment>');

        return 0;
    }
}
