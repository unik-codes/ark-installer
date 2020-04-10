<?php

namespace UnikCodes\Console\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnikCodes\Console\Commander;

class MakeComposeCommand extends Commander
{
    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this
            ->setName('composer')
            ->setDescription('Install ark dependencies')
            ->addArgument('path', InputArgument::OPTIONAL, 'Path of the project to be create');
    }

    /**
     * Execute the command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getArgument('path');

        if (! file_exists($path)) {
            $output->writeln('<error>' . $path . ' does not exists!</error>');

            return 1;
        }

        $current_directory = getcwd();

        chdir($path);

        $output->writeln('<info>Installing Ark dependencies.</info>');
        exec($this->findComposer() . ' require ' . $this->getPackages() . ' -q -n');

        $output->writeln('<info>Installing Ark dev dependencies.</info>');
        exec($this->findComposer() . ' require ' . $this->getDevPackages() . ' --dev -q -n');

        chdir($current_directory);

        $output->writeln('<info>You may need to go to these packages page for further installation setup.</info>');
        $output->writeln('<comment>https://github.com/404labfr/laravel-impersonate</comment>');
        $output->writeln('<comment>https://github.com/laravel/passport</comment>');
        $output->writeln('<comment>https://github.com/owen-it/laravel-auditing</comment>');
        $output->writeln('<comment>https://github.com/predis/predis</comment>');
        $output->writeln('<comment>https://github.com/realrashid/sweet-alert</comment>');
        $output->writeln('<comment>https://github.com/tightenco/ziggy</comment>');
        $output->writeln('<comment>https://github.com/yadahan/laravel-authentication-log</comment>');
        $output->writeln('<comment>https://github.com/spatie/image-optimizer</comment>');
        $output->writeln('<comment>https://github.com/spatie/laravel-medialibrary</comment>');
        $output->writeln('<comment>https://github.com/spatie/laravel-permission</comment>');
        $output->writeln('<comment>https://github.com/cleaniquecoders/blueprint-macro</comment>');
        $output->writeln('<comment>https://github.com/cleaniquecoders/laravel-observers</comment>');
        $output->writeln('<comment>https://github.com/cleaniquecoders/laravel-uuid</comment>');
        $output->writeln('<comment>https://github.com/cleaniquecoders/laravel-helper</comment>');
        $output->writeln('<info>Thank you for using Ark Compose!</info>');

        return 0;
    }

    private function getPackages()
    {
        return 'lab404/laravel-impersonate laravel/passport owen-it/laravel-auditing predis/predis realrashid/sweet-alert tightenco/ziggy yadahan/laravel-authentication-log spatie/image-optimizer spatie/laravel-medialibrary spatie/laravel-permission cleaniquecoders/blueprint-macro cleaniquecoders/laravel-observers cleaniquecoders/laravel-uuid cleaniquecoders/laravel-helper';
    }

    private function getDevPackages()
    {
        return 'barryvdh/laravel-debugbar laravel-frontend-presets/tailwindcss laravel/dusk';
    }
}
