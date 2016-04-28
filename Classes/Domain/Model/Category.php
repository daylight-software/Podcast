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
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


namespace Educo\Podcast\Domain\Model;
use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 *
 *
 * @package podcast
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Sucategory
	 *
	 * @var \Educo\Podcast\Domain\Model\Category
	 */
	protected $subcategory;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{

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
	 * Returns the subcategory
	 *
	 * @return \Educo\Podcast\Domain\Model\Category $subcategory
	 */
	public function getSubcategory()
	{
		return $this->subcategory;
	}

	/**
	 * Sets the subcategory
	 *
	 * @param \Educo\Podcast\Domain\Model\Category $subcategory
	 * @return void
	 */
	public function setSubcategory(Category $subcategory)
	{
		$this->subcategory = $subcategory;
	}

}

?>