<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Settings_LSWYSIWYG_Module_Model extends Settings_Vtiger_Module_Model {

	var $nameFields = array();
	var $name = 'LSWYSIWYG';


	/**
	 * Function to get Create view url
	 * @return <String> Url
	 */
	public function getCreateRecordUrl() {
		return 'javascript:Settings_SMSNotifier_List_Js.triggerEdit(event, "index.php?module='.$this->getName().'&parent='.$this->getParentName().'&view=Edit")';
	}

	/**
	 * Function to get List view url
	 * @return <String> Url
	 */
	public function getListViewUrl() {
		return "index.php?module=".$this->getName()."&parent=".$this->getParentName()."&view=List";
	}

  function getModules(){
    //returns a list of all modules in the database and whether we are enabled for them or not
    global $adb;
    $query="select vtiger_tab.tabid,vtiger_tab.tablabel as modulename,linklabel from vtiger_tab left join vtiger_links on vtiger_tab.tabid=vtiger_links.tabid and linklabel='WYSIWYG'
where isentitytype=1 and tablabel!='Comments'";
    $result=$adb->pquery($query,array());
    while($resultrow = $adb->fetch_array($result)) {
      $modulelist[$resultrow['modulename']]=array('enabled'=>$resultrow['linklabel']=="WYSIWYG",'tabid'=>$resultrow['tabid']);
    }
    return $modulelist;
  }

  public static function getInstance() {
    $moduleModel = new self();
    return $moduleModel;
  }

  public function setData($result){
    parent::setData($result);
  }
  public function save(){
		return true;
	}


}
