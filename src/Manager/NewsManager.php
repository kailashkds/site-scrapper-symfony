<?php

namespace App\Manager;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;

class NewsManager
{
	/**
	 * @EntityManagerInterface
	 */
	private $em;

	public function __construct(EntityManagerInterface $em) 
	{
		$this->em = $em;
	}

	public function createOrUpdate($title, $shortDescription, $picture, $dateAdded)
	{
		$news = $this->findOrCreate($title);
		$news->addBulkData($title, $shortDescription, $picture, $dateAdded);
		$this->em->persist($news);
		$this->em->flush();
	}

	public function findOrCreate($title)
	{
		$news = $this->em->getRepository(News::class)->findByTitle($title);

		if(count($news)) {
			return $news[0];
		}

		return new News();
	}
}