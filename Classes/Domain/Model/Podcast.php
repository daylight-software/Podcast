<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Noël Bossart <n dot company at me dot com>, noelboss.ch
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
namespace Educo\Podcast\Domain\Model;

use DateTime;
use Educo\Podcast\Domain\Model\Category;
use Educo\Podcast\Domain\Model\Episode;
use Educo\Podcast\Domain\Model\Keyword;
use Educo\Podcast\Domain\Model\Person;
use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use \TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Educo\Podcast\Domain\Model\Website;


/**
 *
 *
 * @package podcast
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Podcast extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Subtitle
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $subtitle;

	/**
	 * Description
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $description;

	/**
	 * Copyright
	 *
	 * @var string
	 */
	protected $copyright;

	/**
	 * Image
	 *
	 * @var string
	 */
	protected $image;

	/**
	 * iTunes optimized
	 *
	 * @var boolean
	 */
	protected $itunes;

	/**
	 * Contains explicit Content
	 *
	 * @var string
	 */
	protected $explicit;

	/**
	 * Blocked on iTunes
	 *
	 * @var boolean
	 */
	protected $itunesblock;

	/**
	 * categories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Educo\Podcast\Domain\Model\Category>
	 */
	protected $categories;

	/**
	 * episodes
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Educo\Podcast\Domain\Model\Episode>
	 */
	protected $episodes;

	/**
	 * keywords
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Educo\Podcast\Domain\Model\Keyword>
	 */
	protected $keywords;

	/**
	 * author
	 *
	 * @var Person
	 */
	protected $author;

	/**
	 * technicalContact
	 *
	 * @var Person
	 */
	protected $technicalContact;

	/**
	 * website
	 *
	 * @var Website
	 */
	protected $website;

	/**
	 * Publication Date
	 *
	 * @var DateTime
	 */
	protected $publicationDate;

	/**
	 * Change Time Stamp
	 *
	 * @var DateTime
	 */
	protected $tstamp;

	/**
	 * __construct
	 *
	 */
	public function __construct()
	{
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects()
	{
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();

		$this->episodes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();

		$this->keywords = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * Returns the subtitle
	 *
	 * @return string $subtitle
	 */
	public function getSubtitle()
	{
		return $this->subtitle;
	}

	/**
	 * Sets the subtitle
	 *
	 * @param string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle)
	{
		$this->subtitle = $subtitle;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * Returns the copyright
	 *
	 * @return string $copyright
	 */
	public function getCopyright()
	{
		return str_replace('YEAR', date('Y'), $this->copyright);
	}

	/**
	 * Sets the copyright
	 *
	 * @param string $copyright
	 * @return void
	 */
	public function setCopyright($copyright)
	{
		$this->copyright = $copyright;
	}

	/**
	 * Returns the image
	 *
	 * @return string $image
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param string $image
	 * @return void
	 */
	public function setImage($image)
	{
		$this->image = $image;
	}

	/**
	 * Returns the explicit
	 *
	 * @return string $explicit
	 */
	public function getExplicit()
	{
		return $this->explicit;
	}

	/**
	 * Sets the explicit
	 *
	 * @param string $explicit
	 * @return void
	 */
	public function setExplicit($explicit)
	{
		$this->explicit = $explicit;
	}

	/**
	 * Returns the itunesblock
	 *
	 * @return boolean $itunesblock
	 */
	public function getItunesblock()
	{
		return $this->itunesblock;
	}

	/**
	 * Sets the itunesblock
	 *
	 * @param boolean $itunesblock
	 * @return void
	 */
	public function setItunesblock($itunesblock)
	{
		$this->itunesblock = $itunesblock;
	}

	/**
	 * Returns the itunes
	 *
	 * @return boolean $itunes
	 */
	public function getItunes()
	{
		return $this->itunes;
	}

	/**
	 * Returns the boolean state of itunes
	 *
	 * @return boolean
	 */
	public function isItunes()
	{
		return $this->getItunes();
	}

	/**
	 * Adds a Category
	 *
	 * @param Category $category
	 * @return void
	 */
	public function addCategory(Category $category)
	{
		$this->categories->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(Category $categoryToRemove)
	{
		$this->categories->detach($categoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Educo\Podcast\Domain\Model\Category> $categories
	 */
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage <Educo\Podcast\Domain\Model\Category> $categories
	 * @return void
	 */
	public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories)
	{
		$this->categories = $categories;
	}

	/**
	 * Adds a Episode
	 *
	 * @param Episode $episode
	 * @return void
	 */
	public function addEpisode(Episode $episode)
	{
		$this->episodes->attach($episode);
	}

	/**
	 * Removes a Episode
	 *
	 * @param Episode $episodeToRemove The Episode to be removed
	 * @return void
	 */
	public function removeEpisode(Episode $episodeToRemove)
	{
		$this->episodes->detach($episodeToRemove);
	}

	/**
	 * Returns the episodes
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Educo\Podcast\Domain\Model\Episode> $episodes
	 */
	public function getEpisodes()
	{
		return $this->episodes;
	}

	/**
	 * Sets the episodes
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage <Educo\Podcast\Domain\Model\Episode> $episodes
	 * @return void
	 */
	public function setEpisodes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $episodes)
	{
		$this->episodes = $episodes;
	}

	/**
	 * Returns the author
	 *
	 * @return Person $author
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * Sets the author
	 *
	 * @param Person $author
	 * @return void
	 */
	public function setAuthor(Person $author)
	{
		$this->author = $author;
	}

	/**
	 * Returns the technicalContact
	 *
	 * @return Person $technicalContact
	 */
	public function getTechnicalContact()
	{
		return $this->technicalContact;
	}

	/**
	 * Sets the technicalContact
	 *
	 * @param Person $technicalContact
	 * @return void
	 */
	public function setTechnicalContact(Person $technicalContact)
	{
		$this->technicalContact = $technicalContact;
	}

	/**
	 * Returns the website
	 *
	 * @return Website $website
	 */
	public function getWebsite()
	{
		return $this->website;
	}

	/**
	 * Sets the website
	 *
	 * @param Website $website
	 * @return void
	 */
	public function setWebsite(Website $website)
	{
		$this->website = $website;
	}

	/**
	 * Adds a Keyword
	 *
	 * @param Keyword $keyword
	 * @return void
	 */
	public function addKeyword(Keyword $keyword)
	{
		$this->keywords->attach($keyword);
	}

	/**
	 * Removes a Keyword
	 *
	 * @param Keyword $keywordToRemove The Keyword to be removed
	 * @return void
	 */
	public function removeKeyword(Keyword $keywordToRemove)
	{
		$this->keywords->detach($keywordToRemove);
	}

	/**
	 * Returns the keywords
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Educo\Podcast\Domain\Model\Keyword> $keywords
	 */
	public function getKeywords()
	{
		return $this->keywords;
	}

	/**
	 * Sets the keywords
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage <Educo\Podcast\Domain\Model\Keyword> $keywords
	 * @return void
	 */
	public function setKeywords(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $keywords)
	{
		$this->keywords = $keywords;
	}

	/**
	 * Returns the publicationDate
	 *
	 * @return DateTime $publicationDate
	 */
	public function getPublicationDate()
	{
		return $this->publicationDate;
	}

	/**
	 * Sets the publicationDate
	 *
	 * @param DateTime $publicationDate
	 * @return void
	 */
	public function setPublicationDate($publicationDate)
	{
		$this->publicationDate = $publicationDate;
	}

	/**
	 * Returns the tstamp
	 *
	 * @return DateTime $tstamp
	 */
	public function getTstamp()
	{
		return $this->tstamp;
	}
}

?>