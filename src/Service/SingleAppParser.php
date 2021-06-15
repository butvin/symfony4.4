<?php

namespace App\Service;

use App\Entity\GooglePlaySingleApp;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\AppId;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Exception\GooglePlayException;

class SingleAppParser
{
    public const APP_URL = 'https://play.google.com/store/apps/details?id=com.supercell.boombeach';

    protected GPlayApps $gplay;
    protected AppId $appId;

    protected EntityManagerInterface $em;
    protected MessageBusInterface $bus;

    public function __construct(EntityManagerInterface $em,  MessageBusInterface $bus)
    {
        $this->em = $em;
        $this->bus = $bus;
        $this->gplay = new GPlayApps();
        //$this->appId = new AppId();
    }

    private function getFullUrl(string $url)
    {
        return '';
    }

    private function getStoreId(string $url): ?AppId
    {
        $parts = parse_url($url);

        parse_str($parts['query'], $query);

        try {
            $appId = new AppId((string)$query['id']);
        } catch(GooglePlayException|\LogicException $e) {
            throw new GooglePlayException($e->getMessage());
        }

        return $appId;
    }

    /**
     * @return Category[]
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     */
    private function getAllCategories(): array
    {
        return $this->gplay->getCategories();
    }

    public function execute(string $url): void
    {
        $appId = $this->getStoreId($url);

        $this->gplay->getAppInfo($appId);
    }
}