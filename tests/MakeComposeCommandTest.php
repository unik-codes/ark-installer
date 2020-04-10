<?php

namespace UnikCodes\Console\Tests;

class MakeComposeCommandTest extends \Orchestra\Testbench\TestCase
{
    /** @test */
    public function is_make_new_command_exists()
    {
        $this->assertTrue(class_exists(\UnikCodes\Console\Commands\MakeComposeCommand::class));
    }
}
