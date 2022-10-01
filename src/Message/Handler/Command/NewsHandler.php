<?php
declare(strict_types=1);

namespace App\Message\Handler\Command;

use App\Message\Command\News;
use App\Manager\NewsManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class NewsHandler implements MessageHandlerInterface
{

    /**
     * @NewsManager
     */
    private $newsManager;

    public function __construct(NewsManager $newsManager)
    {
        $this->newsManager = $newsManager;
    }

    public function __invoke(News $news)
    {
        $this->newsManager->createOrUpdate($news->getTitle(), $news->getShortDescription(), $news->getPicture(), $news->getDateAdded());
    }
}