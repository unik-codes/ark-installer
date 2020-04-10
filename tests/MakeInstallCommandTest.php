<?php

namespace UnikCodes\Console\Tests;

use Illuminate\Filesystem\Filesystem;

/**
 * @todo More assertions on each installation - medialibrary, migration, docs, seeder, support, model
 */
class MakeInstallCommandTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Filesystem.
     *
     * @var Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->filesystem = new Filesystem();
        $this->stub_path  = __DIR__ . '/../stubs/';
    }

    /** @test */
    public function is_make_new_command_exists()
    {
        $this->assertTrue(class_exists(\UnikCodes\Console\Commands\MakeInstallCommand::class));
    }

    /** @test */
    public function is_stubs_exists()
    {
        $locations = [
            'app/Config/',
            'app/Config/MediaPathGenerator.php',
            'app/Support/',
            'app/Models/',
            'app/Models/Base.php',
            'app/Models/User.php',
            'app/Support/',
            'app/Support/_.php',
            'app/Support/env.php',
            'app/Support/global.php',
            'app/Support/navigation.php',
            'app/Support/str.php',
            'app/Traits/',
            'app/Traits/Seeds/',
            'app/Traits/Seeds/SeedDatum.php',
            'app/Traits/Seeds/SeedingProgressBar.php',
            'app/Traits/HasMediaExtended.php',
            'database/',
            'database/migrations/',
            'database/migrations/2014_10_12_000000_create_users_table.php',
            'database/migrations/2017_09_01_000000_create_authentication_log_table.php',
            'database/migrations/2019_08_19_000000_create_failed_jobs_table.php',
            'database/migrations/2020_04_09_092021_create_permission_tables.php',
            'database/migrations/2020_04_09_094328_create_media_table.php',
            'database/migrations/2020_04_09_103535_create_audits_table.php',
            'docs/',
            'docs/CODE_OF_CONDUCT.md',
            'docs/CONTRIBUTING.md',
            'docs/ISSUE_TEMPLATE.md',
            'docs/PULL_REQUEST_TEMPLATE.md',
            'stubs',
            'stubs/model.stub',
            '',
        ];
        foreach ($locations as $location) {
            $this->assertTrue($this->filesystem->exists($this->stub_path . $location));
        }
    }
}
