<?php

namespace UnikCodes\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command;

class Commander extends Command
{
    /**
     * Filesystem.
     *
     * @var Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    public function __construct($name = null)
    {
        if (! $this->gitInstalled()) {
            throw new \Exception('Git are not installed in your machine!');
        }

        if (! $this->composerInstalled()) {
            throw new \Exception('Composer are not installed in your machine!');
        }

        parent::__construct($name);
        $this->filesystem = new Filesystem();
    }

    /**
     * Initiliase git repository.
     *
     * @return void
     */
    public function gitInit()
    {
        if ($this->gitInstalled()) {
            exec('git init && git add . && git commit -m "Initial Commits"');
        }
    }

    /**
     * Commit composer.lock on update dependencies.
     *
     * @return void
     */
    public function gitCommitUpdateDependecies()
    {
        if ($this->gitInstalled()) {
            exec('git add composer.lock && git commit -m "Upadate dependencies"');
        }
    }

    /**
     * Check if git is installed.
     */
    public function gitInstalled(): bool
    {
        return ! empty(exec('which git'));
    }

    /**
     * Check if git is installed.
     */
    public function composerInstalled(): bool
    {
        return ! empty(exec('which composer')) || file_exists(getcwd() . '/composer.phar');
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    public function findComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" composer.phar';
        }

        return 'composer';
    }

    /**
     * Get Composer Configuration.
     *
     * @param string $path
     *
     * @return json
     */
    public function getComposerConfig($path)
    {
        $composerJson = file_get_contents($path . DIRECTORY_SEPARATOR . 'composer.json');

        return json_decode($composerJson);
    }

    /**
     * Get Qualified Namespace from Path Given.
     *
     * @param string $path
     *
     * @return string
     */
    public function getQualifiedNamespaceFromPath($path)
    {
        $json               = $this->getComposerConfig($path);
        $qualifiedNamespace = key((array) $json->autoload->{'psr-4'});

        return $qualifiedNamespace;
    }

    /**
     * Install Package Dependencies.
     */
    public function composerInstall()
    {
        if ('testing' != env('APP_ENV')) {
            exec($this->findComposer() . ' install --no-progress --no-suggest');
        }
    }

    /**
     * UPdate Package Dependencies.
     */
    public function composerUpdate()
    {
        if ('testing' != env('APP_ENV')) {
            exec($this->findComposer() . ' update --no-progress --no-suggest');
        }
    }

    /**
     * Link local package to target project.
     *
     * @see http://calebporzio.com/bash-alias-composer-link-use-local-folders-as-composer-dependancies/
     *
     * @param string $name
     * @param string $pathOrUrl
     */
    public function composerLink($name, $pathOrUrl)
    {
        if ('testing' != env('APP_ENV')) {
            exec($this->findComposer() . ' config repositories.' . $name . ' \'{"type": "path", "url": "' . $pathOrUrl . '"}\' --file composer.json');

            return true;
        }

        return false;
    }

    public function cleanupName($value)
    {
        return Str::slug($value, '-');
    }

    public function getQualifiedClassName($package)
    {
        return Str::studly($package);
    }

    public function getPackageName($package)
    {
        return strtolower($this->cleanupName($package));
    }

    public function getVendorName($vendor)
    {
        return strtolower($this->cleanupName($vendor));
    }

    public function getQualifiedNamespace($vendor, $package)
    {
        return Str::studly($vendor) . '\\' . Str::studly($package);
    }
}
