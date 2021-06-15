<?php

namespace App\Service;

use App\Entity\GooglePlaySingleApp as Application;
use App\Repository\GooglePlaySingleAppRepository as ApplicationRepository;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

use Raulr\GooglePlayScraper\Scraper;

class AppParser
{
    public const APP_URL = 'https://play.google.com/store/apps/details?id=com.supercell.boombeach';

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
        $this->googlePlay->setDefaultLang(Application::DEFAULT_LANGUAGE);
        $this->googlePlay->setDelay(200);
    }

    private function getGooglePlayId(string $url): ?string
    {
        $parts = parse_url($url);
        parse_str($parts['query'], $query);

        return $query['id'];
    }

    private function getAllCategories(): array
    {
        return $this->gplay->getCategories();
    }

    public function execute(string $url): void
    {
        $appId = $this->getGooglePlayId($url);

        $appInfo = $this->googlePlay->getApp($appId);

//        dump($appInfo);
        dump( $this->googlePlay->getCollections() );
        dump( $this->googlePlay->getList('free', 'SOCIAL'));
    }
}