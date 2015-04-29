<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
require_once('data/CRMEntity.php');
require_once('data/Tracker.php');
include_once('vtlib/Vtiger/Event.php');
class LSWYSIWYG{
	function addlinks(){
		//here we add the export buttons to all the modules that get them by default
    Vtiger_Link::addLink(0, 'HEADERSCRIPT', 'LSWYSIWYG', 'modules/LSWYSIWYG/resources/WYSIWYG.js','','','');

	}
	function removelinks(){
		//here we remove our links from all modules that have them, including custom modules

    Vtiger_Link::deleteLink(0, 'HEADERSCRIPT', 'LSWYSIWYG', 'modules/LSWYSIWYG/resources/WYSIWYG.js','','','');
	}
	/**
	* Invoked when special actions are performed on the module.
	* @param String Module name
	* @param String Event Type
	*/
	function vtlib_handler($moduleName, $eventType) {
		global $adb;
 		if($eventType == 'module.postinstall') {
			$this->addlinks();
		} else if($eventType == 'module.enabled') {
			$this->addlinks();
		} else if($eventType == 'module.disabled') {
			$this->removelinks();
		} else if($eventType == 'module.preuninstall') {
			$this->removelinks();
		} else if($eventType == 'module.preupdate') {
			// TODO Handle actions before this module is updated.
		} else if($eventType == 'module.postupdate') {
			// TODO Handle actions after this module is updated.
		}
 	}
}
