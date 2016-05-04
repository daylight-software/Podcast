<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

const vendor = "Educo.";

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	vendor.$_EXTKEY,
	'Display',
	array(
		'Podcast' => 'index,show',
	),
	array(
		'Podcast' => '',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	vendor.$_EXTKEY,
	'Episodes',
	array(
		'Episode' => 'list',
	),
	array(
		'Episode' => '',
	)
);

require \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/RealURL/default.php';

$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['Educo.' . $_EXTKEY] = 'Educo\Podcast\Utilities\Backend\EpisodePostProcessor';

?>