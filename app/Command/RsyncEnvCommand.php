<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Psr\Container\ContainerInterface;

/**
 * @Command
 */
class RsyncEnvCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('cron:commandTest');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('test command');
    }

    public function handle()
    {
        $this->line('test command', 'error');
        $this->info('info');
        $this->warn('warning');
        $this->error('error');

        $this->line('test command success', 'info');
    }
}
