<?php

namespace App\Scraper;

use App\Entity\Source;
use App\Message\Command\News;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Panther\Client;
use Symfony\Component\Messenger\MessageBusInterface;

class Scraper
{
    /**
     * @MessageBusInterface
     */
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus) {
        $this->messageBus = $messageBus;
    }

    public function scrap(Source $source): bool
    {
        $client = Client::createChromeClient(null, [ '--headless', '--disable-dev-shm-usage', '--no-sandbox' ]);

        $crawler = $client->request('GET', $source->getUrl());
        $crawler->filter($source->getWrapperSelector())->each(function (Crawler $c) use ($source) {
            /// Find and filter the title
            $title = $c->filter($source->getSourceTitle())->text();
            $shortDescription = $c->filter($source->getSourceShortDescription())->text();
            $img = $c->filter($source->getSourcePicture())->attr('data-lazy-srcset');
            $picture = explode(" ",$img)[0];            
            $dateTime = $c->filter($source->getSourceAddDate())->text();
            
            try {
                $this->messageBus->dispatch(
                    new News($title, $shortDescription, $picture, $dateTime)
                );
            } catch (Exception $exception) {
                throw new Exception('Sync went wrong.');
            }

        });

        return true;
    }
}