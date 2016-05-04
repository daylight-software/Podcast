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


use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class EpisodeController extends ActionController
{
    /**
     * episodeRepository
     *
     * @var \Educo\Podcast\Domain\Repository\EpisodeRepository
     * @inject
     */
    protected $episodeRepository;

    /**
     * action list
     *
     * @return void
     */
    public function listAction() {
        $episodes = $this->episodeRepository->findByKeyword($this->settings['episodeKeyword']);
        $this->view->assign('settings', $this->settings);
        $this->view->assign('episodes', $episodes);
    }


}