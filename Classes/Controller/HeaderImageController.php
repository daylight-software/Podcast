<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 educo gmbh <info at educo dot ch>, educo.ch
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

use Educo\Podcast\Domain\Model\Episode;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class HeaderImageController extends ActionController
{
    /**
     * podcastRepository
     *
     * @var \Educo\Podcast\Domain\Repository\PodcastRepository
     * @inject
     */
    protected $podcastRepository;

    /**
     * episodeRepository
     *
     * @var \Educo\Podcast\Domain\Repository\EpisodeRepository
     * @inject
     */
    protected $episodeRepository;

    /**
     * show header image
     */
    public function showAction() {
        $episodesControllerParameter = GeneralUtility::_GP('tx_podcast_episodes');
        $episodeId = $episodesControllerParameter['episode'];
        $episode = $this->episodeRepository->findByUid(intval($episodeId));
        /** @var \Educo\Podcast\Domain\Model\Episode $episode */
        if ($episode !== null) {
            $this->view->assign('image', $episode->getTeaserimage());
        }
        else if (intval($this->settings['singlePodcast']) > 0) {
            $this->settings['noBackButton'] = 1;
            $podcastResult = $this->podcastRepository->findOneByUid(intval($this->settings['singlePodcast']));
            /** @var \Educo\Podcast\Domain\Model\Podcast $podcast */
            $podcast = $podcastResult->getFirst();
            $this->view->assign('image', $podcast->getImage());
        }
    }
}