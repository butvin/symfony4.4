<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Raulr\GooglePlayScraper\Scraper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Entity\Application;
use App\Repository\ApplicationRepository;
use App\Service\ApplicationParser;

class ParseUrlCommand extends Command
{
    protected static $defaultName = 'parse:url';
    protected static $defaultDescription = 'Parse URL to Application from Google Play Market';

    protected EntityManagerInterface $em;
    protected MessageBusInterface $bus;
    protected ApplicationRepository $applicationRepository;

    protected Scraper $googlePlay;

    public function __construct(
        EntityManagerInterface $em,
        MessageBusInterface $bus,
        ApplicationRepository $applicationRepository
    ) {
        $this->em = $em;
        $this->bus = $bus;
        $this->applicationRepository = $applicationRepository;
        $this->googlePlay = new Scraper();
        $this->googlePlay->setDefaultCountry(Application::DEFAULT_COUNTRY);
        $this->googlePlay->setDefaultLang(Application::DEFAULT_LOCALE);
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('url', InputArgument::REQUIRED, 'Input URL to Google Play Application')
        ;
    }

    protected function execute( InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $url = $input->getArgument('url');

        if ($url) {
            $io->title('Starting parser... please wait');
            $io->note(sprintf('URL is: %s', $url));

            $parser = new ApplicationParser(
                $this->em,
                $this->bus,
                $this->applicationRepository
            );

            $parser->execute($url);
        }

        $io->success('Parser is stopped.');

        return 0;
    }
}
