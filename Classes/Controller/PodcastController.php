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
namespace Educo\Podcast\Controller;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use Educo\Podcast\Domain\Model\Podcast;
use Educo\Podcast\Domain\Repository\PodcastRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;


/**
 *
 *
 * @package podcast
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class PodcastController extends ActionController
{

	/**
	 * podcastRepository
	 *
	 * @var \Educo\Podcast\Domain\Repository\PodcastRepository
	 */
	protected $podcastRepository;

	/**
	 * injectPodcastRepository
	 *
	 * @param PodcastRepository $podcastRepository
	 * @return void
	 */
	public function injectPodcastRepository(PodcastRepository $podcastRepository)
	{
		$this->podcastRepository = $podcastRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction()
	{
		if ($this->podcastRepository->countAll() < 1) {
			$podcasts = $this->podcastRepository->findAllWithoutPidRestriction();
		} else {
			$podcasts = $this->podcastRepository->findAll();
		}
		if ($podcasts->count() < 1) {
			$this->addFlashMessage('No Podcasts found.');
		}
		$this->view->assign('settings', $this->settings);
		$this->view->assign('podcasts', $podcasts);
	}

	/**
	 * Index action, show a single podcast
	 *
	 * @param $podcast
	 * @return void
	 */
	public function showAction(Podcast $podcast = NULL)
	{
		if (!$podcast && intval($this->settings['singlePodcast']) > 0) {
			$this->settings['noBackButton'] = 1;
			$podcast = $this->podcastRepository->findOneByUid(intval($this->settings['singlePodcast']));
			$podcast = $podcast->getFirst();
		} else if (!$podcast) {
			$this->redirect('list');
		}

		$this->updatePodcast($podcast);

		if ($this->settings['feed']) {
			$this->request->setFormat('xml');
			$lang = $this->settings['ll']['language'];
			$this->view->assign('language', $lang ? $lang : $GLOBALS['TSFE']->config['config']['htmlTag_langKey']);
		}

		$this->view->assign('baseUrl', $this->controllerContext->getRequest()->getBaseURI());
		$this->view->assign('settings', $this->settings);
		$this->view->assign('podcast', $podcast);
	}

	/**
	 * Updates podcast duration
	 *
	 * @param $podcast \Educo\Podcast\Domain\Model\Podcast
	 * @return void
	 */
	private function updatePodcast(Podcast $podcast)
	{
		$change = false;
		foreach ($podcast->getEpisodes() as $episode) {
			if ($episode->getDuration() < 1) {
				$change = true;
				$episode->getAltfiles();
			}
		}
		if ($change) {
			$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
			$persistenceManager->persistAll();
		}
	}
}

?>