<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Importer_zoo
 *
 * @copyright   Copyright (C) 2016 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('joomla.plugin.plugin');

// Load ZOO config
require_once JPATH_ADMINISTRATOR . '/components/com_zoo/config.php';

/**
 * Clientcolumns Resource for Importer_zoo Plugin.
 *
 * @since  2.5
 */
class Importer_ZooApiResourceClientvalidate extends ApiResource
{
	/**
	 * GET function to fetch columns in zoo
	 *
	 * @return  JSON  types details
	 *
	 * @since  3.0
	 **/
	public function get()
	{
		// $this->plugin->setResponse("POST method is not supporter, try GET method");
		die("in get funtion");
	}

	/**
	 * POST function unnecessary
	 *
	 * @return  STRING  error message
	 * 
	 * @since  3.0
	 **/
	public function post()
	{
		$this->zapp		= App::getInstance('zoo');
		$columns_array	= $decodeFile = array();
		$jinput			= JFactory::getApplication()->input;

		$checkRecords 	= (array) json_decode($jinput->get('records', '', 'STRING'));
		$batch 			= json_decode($jinput->get('batchDetails', '', 'STRING'));
		$type			= $batch->params->type;
		$filePath		= JPATH_SITE . '/media/zoo/applications/blog/types/' . $type . '.config';

		if (JFile::exists($filePath))
		{
			$decodeFile		= (array) json_decode(JFile::read($filePath));
			$decodeElements = (array) $decodeFile['elements'];
			$invalidRec		= array();
			$invalidEle		= array();

			$decodeElements['alias']->type = 'alias';

			foreach ($checkRecords as $record)
			{
				$invalidEle	= $this->validate((array) $record, $decodeElements);
				$invalidRec[$record->tempId] = $invalidEle;
			}

			$this->plugin->setResponse($invalidRec);
		}
		else
		{
			die("Type file not found");
		}

		return;
	}

	/**
	 * POST function unnecessary
	 *
	 * @param   Array  $record          A single record from temp table
	 * @param   Array  $decodeElements  Field element details
	 * 
	 * @return  STRING  error message
	 * 
	 * @since  3.0
	 **/
	public function validate($record, $decodeElements)
	{
		$invalidFields = null;

		if (!empty(array_filter($record)))
		{
			foreach ($record as $recordKey => $recordData)
			{
				if (array_key_exists($recordKey, $decodeElements))
				{
					switch ($decodeElements[$recordKey]->type)
					{
						case 'alias' :
								$correctVal = $this->zapp->string->sluggify($recordData);

								if ($recordData != $correctVal)
								{
									$invalidFields[] = $recordKey;
								}
							break;
					}
				}
			}
		}

		return $invalidFields;
	}
}
