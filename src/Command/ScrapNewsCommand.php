<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Entity\Source;

class ScrapNewsCommand extends Command
{
    protected static $defaultName = 'scrap:news';
    protected static $defaultDescription = 'Command to sync news';
    
    private $container;

    public function __construct(ContainerInterface $container) {
        parent::__construct(self::$defaultName);

        $this->container = $container;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->info('Sync started!');

        $sourceRepo = $this->container->get('doctrine.orm.entity_manager')->getRepository(Source::class);
        foreach($sourceRepo->findAll() as $source)
        {
            $name = $source->getName();
            $io->info("$name Sync started");
            $scrapperService = $this->container->get($source->getScraperClass());
            $scrapperService->scrap($source);
            $io->info("$name Sync Ended");
        }

        $io->info("Sync started");

        $io->success('Command Executed SUCCESS!');

        return Command::SUCCESS;
    }
}
