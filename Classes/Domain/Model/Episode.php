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
use getID3;
use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use \TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Educo\Podcast\Domain\Model\Keyword;
use Educo\Podcast\Domain\Model\Person;
use Educo\Podcast\Domain\Model\Website;

/**
 *
 *
 * @package podcast
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Episode extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * VideoCode
	 *
	 * @var string
	 */
	protected $videocode;


	/**
	 * Blocked on iTunes
	 *
	 * @var boolean
	 */
	protected $itunesblock;

	/**
	 * Subtitle
	 *
	 * @var string
	 */
	protected $subtitle;

	/**
	 * Summary
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $description;

	/**
	 * File
	 *
	 * @var string
	 */
	protected $file;

	/**
	 * Filesize
	 *
	 * @var string
	 */
	protected $filesize;

	/**
	 * Image
	 *
	 * @var string
	 */
	protected $image;

	/**
	 * Teaser Image
	 *
	 * @var string
	 */
	protected $teaserimage;

	/**
	 * Link to detail page
	 *
	 * @var string
	 */
	protected $linkdetail;

	/**
	 * Publication Date
	 *
	 * @var DateTime
	 */
	protected $publicationDate;

	/**
	 * Duration
	 *
	 * @var integer
	 */
	protected $duration;

	/**
	 * mime
	 *
	 * @var string
	 */
	protected $mime;

	/**
	 * altfiles
	 *
	 * @var string
	 */
	protected $altfiles;

	/**
	 * website
	 *
	 * @var Website
	 */
	protected $website;

	/**
	 * author
	 *
	 * @var Person
	 */
	protected $author;

	/**
	 * keywords
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Educo\Podcast\Domain\Model\Keyword>
	 */
	protected $keywords;

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
	 * Returns the videocode
	 *
	 * @return string $videocode
	 */
	public function getVideocode()
	{
		return $this->videocode;
	}

	/**
	 * Sets the videocode
	 *
	 * @param string $videocode
	 * @return void
	 */
	public function setVideocode($videocode)
	{
		$this->videocode = $videocode;
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
	 * Returns the file
	 *
	 * @return string $file
	 */
	public function getFile()
	{
		if (\TYPO3\CMS\Core\Utility\GeneralUtility::isFirstPartOfStr($this->file, 'file:')) {
			// this helped; https://github.com/TYPO3/TYPO3v4-Core/blob/master/typo3/sysext/frontend/Classes/ContentObject/FilesContentObject.php
			// Get the UID from the current image object.
			$fileUid = substr($this->file, 5);
			$fileObjects = array();
			$fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
			$fileObjects = $fileRepository->findByUid($fileUid);
			$fileObjectData = $fileObjects->toArray();
			return $fileObjectData['url'];
		}
		return $this->file;
	}

	/**
	 * Returns the file url
	 *
	 * @return string $file
	 */
	public function getFileurl()
	{
		return \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL') . $this->getFile();
	}


	/**
	 * Sets the file
	 *
	 * @param string $file
	 * @return void
	 */
	public function setFile($file)
	{
		$this->file = $file;
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
	 * Returns the teaserimage
	 *
	 * @return string $teaserimage
	 */
	public function getTeaserimage()
	{
		return $this->teaserimage;
	}

	/**
	 * Sets the teaserimage
	 *
	 * @param string $teaserimage
	 * @return void
	 */
	public function setTeaserimage($teaserimage)
	{
		$this->teaserimage = $teaserimage;
	}

	/**
	 * Returns the linkdetail
	 *
	 * @return string $linkdetail
	 */
	public function getLinkdetail()
	{
		return $this->linkdetail;
	}

	/**
	 * Sets the linkdetail
	 *
	 * @param string $linkdetail
	 * @return void
	 */
	public function setLinkdetail($linkdetail)
	{
		$this->linkdetail = $linkdetail;
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
	 * Returns the duration
	 *
	 * @return integer $duration
	 */
	public function getDuration()
	{
		return $this->duration;
	}

	/**
	 * set duration
	 *
	 * @param integer $duration
	 */
	public function setDuration($duration)
	{
		$this->duration = $duration;
	}

	/**
	 * Returns the mime
	 *
	 * @return string $mime
	 */
	public function getMime()
	{
		return $this->mime;
	}

	/**
	 * Set the mime
	 *
	 * @param string $mime
	 */
	public function setMime($mime)
	{
		$this->mime = $mime;
	}


	/**
	 * Sets the mime
	 *
	 * @param $file
	 * @return string
	 */
	private function getFileMime($file)
	{
		$mime = '';
		$file = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($file);
		if ($fp = fopen($file, 'rb')) {
			//This will set the Content-Type to the appropriate setting for the file
			$fileinfo = pathinfo($file);
			$file_extension = strtolower($fileinfo['extension']);
			switch ($file_extension) {
				case 'm4a':
					$mime = 'audio/x-m4a';
					break;
				case 'mp4':
					$mime = 'video/mp4';
					break;
				case 'm4v':
					$mime = 'video/x-m4v';
					break;
				case 'webm':
					$mime = 'video/webm';
					break;
				case 'mp3':
					$mime = 'audio/mpeg';
					break;
				case 'mov':
					$mime = 'video/quicktime';
					break;
				case 'pdf':
					$mime = 'application/pdf';
					break;
				case 'epub':
					$mime = 'document/x-epub';
					break;
				case 'mpg':
					$mime = 'video/mpeg';
					break;
				case 'avi':
					$mime = 'video/x-msvideo';
					break;
			}
		}
		return $mime;
	}


	/**
	 * Sets the duration
	 *
	 * @param string $file
	 * @return int
	 */
	private function getFileDuration($file)
	{
		$duration = 0;
		$file = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($file);
		if ($fp = fopen($file, 'rb')) {
			require_once('typo3conf/ext/podcast/Classes/Utilities/getid3/getid3.php');

			// Initialize getID3 engine
			$getID3 = new getID3;
			$getID3->option_md5_data = true;
			$getID3->option_md5_data_source = true;
			$getID3->encoding = 'UTF-8';
			$getID3->analyze($file);
			if (empty($getID3->info['error'])) {
				// Init wrapper object
				$result = array();
				$result['playing_time'] = (isset($getID3->info['playtime_seconds']) ? $getID3->info['playtime_seconds'] : '');
				$duration = round($result['playing_time']);

			}
		}
		return $duration;
	}

	/**
	 * Returns the alternative files
	 *
	 * @return string $altfiles
	 */
	public function getAltfiles()
	{
		if (!$this->altfiles) {
			$this->setAltfiles();
		}

		$all = explode('|', $this->altfiles);
		$altfiles = array();
		for ($i = 0; $i < count($all); $i++) {
			$file = explode(',', $all[$i]);
			$altfiles[$i]['name'] = $file[0];
			$altfiles[$i]['mime'] = $file[1];
		}

		return $altfiles;
	}

	/**
	 * Sets the alternative files
	 *
	 * @return void
	 */
	public function setAltfiles()
	{
		$fileInfo = \TYPO3\CMS\Core\Utility\GeneralUtility::split_fileref($this->getFile());

		/* get mime and duration from provided file */
		$this->setMime($this->getFileMime($this->getFile()));
		$this->setDuration($this->getFileDuration($this->getFile()));

		$altfiles = array();
		$altfiles[0] = $this->getFile() . ',' . $this->getMime();

		$basepath = $fileInfo['path'] . $fileInfo['filebody'] . '.*';
		$files = glob($basepath);
		/* search for other files */
		for ($i = 0; $i < count($files); $i++) {
			if ($files[$i] != $this->getFile()) {
				$altfiles[$i + 1] = $files[$i] . ',' . $this->getFileMime($files[$i]);
			}
		}
		$this->altfiles = implode('|', $altfiles);
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
	 * Sets the filesize
	 *
	 * @param string $filesize
	 */
	public function setFilesize($filesize)
	{
		$this->filesize = $filesize;
	}

	/**
	 *   Gets the filesize
	 *
	 * @return string filesize
	 */
	public function getFilesize()
	{
		return $this->filesize;
	}
}