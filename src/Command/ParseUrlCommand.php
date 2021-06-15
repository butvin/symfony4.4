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

use App\Entity\GooglePlaySingleApp as Application;
use App\Repository\GooglePlaySingleAppRepository as ApplicationRepository;
use App\Service\AppParser;

class ParseUrlCommand extends Command
{
    protected static $defaultName = 'parse:url';
    protected static $defaultDescription = 'Parse URL to Application from Google Play Market';

    protected EntityManagerInterface $em;
    protected MessageBusInterface $bus;
    protected ApplicationRepository $applicationRepository;
    protected Scraper $googlePlay;

    private AppParser $service;

    public function __construct(
        AppParser $service,
        EntityManagerInterface $em,
        MessageBusInterface $bus,
        ApplicationRepository $applicationRepository
    ) {
        $this->service = $service;
        $this->em = $em;
        $this->bus = $bus;
        $this->applicationRepository = $applicationRepository;
        $this->googlePlay = new Scraper();
        $this->googlePlay->setDefaultCountry(Application::DEFAULT_COUNTRY);
        $this->googlePlay->setDefaultLang(Application::DEFAULT_LANGUAGE);
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
            $io->note(sprintf('URL is: %s', $url));
            $this->service->execute($url);
        }

        $io->success('Parser is stopped.');

        return 0;
    }
}
