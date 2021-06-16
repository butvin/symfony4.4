<?php

namespace App\Service;

use App\Entity\Application;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

use Nelexa\GPlay\GPlayApps;
use Nelexa\GPlay\Model\AppId;
use Nelexa\GPlay\Model\AppInfo;
use Nelexa\GPlay\Model\Category;
use Nelexa\GPlay\Exception\GooglePlayException;

use App\Repository\ApplicationRepository;

class ApplicationParser
{
    public const CONNECTION_TIMEOUT = 5;
    public const APP_URL = 'https://play.google.com/store/apps/details?id=com.supercell.boombeach';

    protected ?GPlayApps $playMarket;
    protected ?AppId $appId;
    protected ?AppInfo $appInfo;

    protected EntityManagerInterface $em;
    protected MessageBusInterface $bus;
    protected ApplicationRepository $applicationRepository;

    public function __construct(
        EntityManagerInterface $em,
        MessageBusInterface $bus,
        ApplicationRepository $applicationRepository
    ) {
        $this->em = $em;
        $this->bus = $bus;
        $this->applicationRepository = $applicationRepository;

        $this->playMarket = new GPlayApps();
    }

    private function getGoogleAppId(string $url): AppId
    {
        $parts = parse_url($url);
        parse_str($parts['query'], $query);

        try {
            $appId = new AppId($query['id']);
        } catch(\LogicException $e) {
            throw new \LogicException($e->getMessage());
        }

        return $appId;
    }

    private function getAllCategories(): array
    {
        return $this->playMarket->getCategories();
    }

    /**
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     */
    public function execute(string $url): void
    {
        $this->playMarket
            ->setDefaultLocale(Application::DEFAULT_LOCALE)
            ->setDefaultCountry(Application::DEFAULT_COUNTRY)
            ->setConcurrency(10)
            ->setProxy(null)
            ->setConnectTimeout(self::CONNECTION_TIMEOUT);

        $this->appId = $this->getGoogleAppId($url);

        $this->appInfo = $this->playMarket->getAppInfo($this->appId);

        $this->storeApplication($this->appInfo);
        dump($this->appInfo);
    }

    /**
     * @throws \Nelexa\GPlay\Exception\GooglePlayException
     * @throws \Exception
     */
    private function storeApplication(AppInfo $app): void
    {
        $application = (new Application())
            ->setGoogleAppsId($app->getId())
            ->setName($app->getName())
            ->setCountry($app->getCountry())
            ->setLocale($app->getLocale())
            ->setIsFree($app->isFree())
            ->setUrl($app->getUrl())
            ->setIconUrl($app->getIcon()->getUrl())
            ->setIconBinary($app->getIcon()->getBinaryImageContent())
            ->setIconPath('public/icon/'.$app->getIcon()->getHashUrl('sha1', 2, 2).'.png')
            ->setDeveloper($app->getDeveloper()->getId())
            ->setCreatedAt( new \DateTime($app->getReleased()->format('Y-m-d H:i:s')))
            ->setUpdatedAt(new \DateTime($app->getUpdated()))
            ->setDeletedAt(null);

        $this->em->persist($application);
        $this->em->flush();
    }
}