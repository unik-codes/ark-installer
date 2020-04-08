<?php

namespace UnikCodes\Console;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;

class Commander extends Command
{
    /**
     * Filesystem.
     *
     * @var Symfony\Component\Filesystem\Filesystem
     */
    protected $filesystem;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->filesystem = new Filesystem();
    }
}
