<?php

namespace UnikCodes\Console\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnikCodes\Console\Commander;

class MakeInstallCommand extends Commander
{
    public $name;
    public $path;
    public $stub_path;

    protected $configs = [
        'medialibrary' => [
            'app/Config'                      => 'Do update <info>path_generator</info> to <info>\App\Config\MediaPathGenerator::class</info> in <info>config/medialibrary.php</info>.',
            'app/Traits/HasMediaExtended.php' => 'You may add in your model <info>use \App\Models\HasMediaExtended;</info>',
        ],
        'docs' => [
            'docs/' => 'Now you have your application standard document on <info>Code of Conduct, Contributing, Issue Template and Pull Request Template.</info>',
        ],
        'seeder' => [
            'app/Traits/Seeds' => 'Now you have <info>Seeder Progress Bar</info> and <info>Seed Datum Trait.</info>',
        ],
        'support' => [
            'app/Support/' => 'Helpers are registered to you application. You may add as many helpers as you like in <info>app\Support</info> directory.',
        ],
        'model' => [
            'app/Models' => 'All models moved to <info>app/Models</info> and added <info>app/Models/Base</info>. Do update your <info>config/auth.php</info>. You may want to remove or update your existing User model in <info>app/</info>.',
            'stubs'      => '<info>Model stub updated.</info>',
        ],
    ];

    protected $extras = [
        'support',
    ];

    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this
            ->setName('install')
            ->setDescription('Install package setup to existing Laravel project')
            ->addArgument('name', InputArgument::REQUIRED, 'Package name')
            ->addArgument('path', InputArgument::REQUIRED, 'Path of the project to install the package');
    }

    /**
     * Execute the command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->name = $name = $input->getArgument('name');
        $this->path = $path = rtrim($input->getArgument('path'), '/') . '/';

        $this->stub_path = $stub_path = __DIR__ . '/../../stubs/';

        if (! $this->filesystem->exists($path)) {
            $output->writeln('<comment>' . $path . ' does not exists!</comment>');

            return 1;
        }

        if (! $this->configs($name)) {
            throw new \Exception('Config not available.', 1);

            return 1;
        }

        $messages = [];
        foreach ($this->configs($name) as $file => $message) {
            $location = $stub_path . $file;

            if ($this->filesystem->isDirectory($location)) {
                $this->filesystem->copyDirectory($location, $path . $file);
                $messages[] = $message;
            }

            if ($this->filesystem->isFile($location)) {
                $this->filesystem->copy($location, $path . $file);
                $messages[] = $message;
            }

            $method = 'handle' . ucfirst($name);
            if (method_exists($this, $method)) {
                $this->{$method}();
            }
        }

        $output->writeln('<comment>' . join($messages, PHP_EOL) . '</comment>');

        return 0;
    }

    private function configs($name)
    {
        if (! isset($this->configs[$name])) {
            return false;
        }

        return $this->configs[$name];
    }

    private function handleSupport()
    {
        $json                  = $this->getComposerConfig(rtrim($this->path, '/'));
        $json->autoload->files = ['app/Support/_.php'];

        $composer_file = $this->path . 'composer.json';
        $this->filesystem->put($composer_file, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $current_directory = getcwd();
        chdir($this->path);
        exec($this->findComposer() . ' dumpautoload -o -q');
        chdir($current_directory);
    }
}
