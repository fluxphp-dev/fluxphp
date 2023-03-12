<?php

namespace FluxPHP\Source\CLI;

use FluxPHP\Source\Database\Migration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateDown extends Command
{
    protected function configure()
    {
        $this->setName('migrate:down')
            ->setDescription("Down migrations to database");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<fg=bright-blue>FluxPHP <fg=white>Migrating...");
        $cfg = \Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $cfg->load();
        $m = new Migration();
        $m->applyMigration("down", $output);
        $output->writeln("<fg=bright-blue>FluxPHP <fg=white>Downed all Migrations!");
        return self::SUCCESS;
    }
}
