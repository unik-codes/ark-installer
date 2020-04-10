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
        $name = $this->cleanupName($input->getArgument('name'));
        $path = $input->getArgument('path')
            ? $input->getArgument('path') . DIRECTORY_SEPARATOR . $name
            : getcwd() . DIRECTORY_SEPARATOR . $name;

        if (file_exists($path)) {
            $output->writeln('<error>Git: ' . $path . ' already exists!</error>');

            return 1;
        }

        $output->writeln('<info>Git:</info> Creating new Ark project named ' . $name);
        exec('composer create-project unik-codes/ark "' . $path . '" --prefer-dist');

        if (file_exists($path)) {
            chdir($path);
            $this->gitInit();
            $output->writeln('<info>Git:</info> Initialise, add all files and commit...');
            $this->composerUpdate();
            $output->writeln('<info>Composer:</info> Update dependencies...');
            $this->gitCommitUpdateDependecies();
            $output->writeln('<info>Git:</info> Commit dependencies...');
        }

        $output->writeln('<info>New Ark created: </info> ' . $input->getArgument('name') . ' is created at ' . $path);
        $output->writeln('<info>Thank you for using Ark!</info>');

        return 0;
    }
}
