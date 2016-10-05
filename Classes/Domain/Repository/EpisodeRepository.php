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

namespace Educo\Podcast\Domain\Repository;


use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class EpisodeRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * Returns all objects of this repository.
     *
     * @param $keywordId int The id of the keyword to filter for
     * @return array|QueryResultInterface
     * @api
     */
    public function findByKeyword($keywordId)
    {
        /** @var \TYPO3\CMS\Extbase\Persistence\Generic\Query $query */
        $query = $this->createQuery();
        // todo use abstact methods instead of SQL code
        // the following approach did not work :-(
        // return $query->matching($query->equals('keyword.uid', $keywordId))->execute();

        $sql = 'SELECT episode.* FROM tx_podcast_domain_model_episode AS episode
				LEFT JOIN tx_podcast_episode_keyword_mm AS episode_keyword_mm ON episode.uid = episode_keyword_mm.uid_local
				WHERE episode_keyword_mm.uid_foreign = ' . intval($keywordId);
        return $query->statement($sql)->execute();
    }
}