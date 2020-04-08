<?php

namespace UnikCodes\Console\Tests;

use Illuminate\Support\Str;
use UnikCodes\Console\Commander;

class CommanderTest extends \Orchestra\Testbench\TestCase
{
    protected $commander;

    public function setUp(): void
    {
        parent::setUp();
        $this->commander = new Commander();
    }

    /** @test */
    public function is_git_installed()
    {
        $this->assertTrue($this->commander->gitInstalled());
    }

    /** @test */
    public function is_composer_installed()
    {
        $this->assertTrue(Str::contains($this->commander->findComposer(), 'composer'));
    }
}
