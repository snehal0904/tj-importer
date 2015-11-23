<?php
/**
 * @version    SVN: <svn_id>
 * @package    TMT
 * @author     Techjoomla <contact@techjoomla.com>
 * @copyright  Copyright (C) 2012-2013 Techjoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * TMT controller Class.
 *
 * @since  1.0
 */
class ImporterController extends JControllerLegacy
{
	/**
		* Method to display the view
		*
		* @param   typenotknown  $cachable   .
		*
		* @param   typenotknown  $urlparams  .
		*
		* @access    public
		*
		* @return nothing
		*/
	public function display($cachable = false, $urlparams = false)
	{
		parent::display();
	}

	/**
		* Method to display the view
		*
		* @access    public
		*
		* @return nothing
		*/
	public function save()
	{
		$model	= $this->getModel('import');
		$this->setRedirect(JURI::base() . "index.php?option=com_importer&view=import");
	}
}