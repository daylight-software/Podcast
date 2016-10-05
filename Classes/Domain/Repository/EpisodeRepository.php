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
        // the following approach did not work: uid in where is empty, hidden and deleted fields are missing
        // $query = $query->matching($query->equals('keywords.uid', $keywordId));

        // debugging code
        /*
        $parser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Storage\\Typo3DbQueryParser');
        $queryParts = $parser->parseQuery($query);
        \TYPO3\CMS\Core\Utility\DebugUtility::debug($queryParts, 'query');

        array(10 items)
   keywords => array(1 item)
      distinct => "DISTINCT" (8 chars)
   tables => array(1 item)
      tx_podcast_domain_model_episode => "tx_podcast_domain_model_episode" (31 chars)
   unions => array(2 items)
      tx_podcast_episode_keyword_mm => "LEFT JOIN tx_podcast_episode_keyword_mm AS tx_podcast_episode_keyword_mm ON
         tx_podcast_domain_model_episode.uid=tx_podcast_episode_keyword_mm.uid_local" (151 chars)
      tx_podcast_domain_model_keyword => "LEFT JOIN tx_podcast_domain_model_keyword AS tx_podcast_domain_model_keyword
          ON tx_podcast_episode_keyword_mm.uid_foreign=tx_podcast_domain_model_keywor
         d.uid" (157 chars)
   fields => array(1 item)
      tx_podcast_domain_model_episode => "tx_podcast_domain_model_episode.*" (33 chars)
   where => array(1 item)
      0 => "tx_podcast_domain_model_keyword.uid = :" (39 chars)
   additionalWhereClause => array(2 items)
      0 => "(tx_podcast_domain_model_episode.sys_language_uid IN (0,-1)) AND tx_podcast_
         domain_model_episode.pid IN (0)" (107 chars)
      1 => "(((tx_podcast_domain_model_keyword.sys_language_uid IN (0,-1)) AND tx_podcas
         t_domain_model_keyword.pid IN (0)) OR tx_podcast_domain_model_keyword.uid IS
          NULL)" (158 chars)
   orderings => array(empty)
   limit => NULL
   offset => NULL
   tableAliasMap => array(3 items)
      tx_podcast_domain_model_episode => "tx_podcast_domain_model_episode" (31 chars)
      tx_podcast_domain_model_keyword => "tx_podcast_domain_model_keyword" (31 chars)
      tx_podcast_episode_keyword_mm => "tx_podcast_episode_keyword_mm" (29 chars)
        */

        $sql = 'SELECT episode.* FROM tx_podcast_domain_model_episode AS episode
				LEFT JOIN tx_podcast_episode_keyword_mm AS episode_keyword_mm ON episode.uid = episode_keyword_mm.uid_local
				WHERE episode_keyword_mm.uid_foreign = ' . intval($keywordId) . ' AND episode.deleted = 0 AND episode.hidden = 0';
        // todo start and end time are not taken into account
        // but they are not visible in the typo3 backend, thus it is not a problem
        $query = $query->statement($sql);


        return $query->execute();
    }
}