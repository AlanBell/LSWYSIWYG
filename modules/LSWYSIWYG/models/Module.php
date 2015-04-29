<?php
class LSWYSIWYG_Module_Model extends Vtiger_Module_Model {
	public function getSettingLinks(){
		$settingsLinks = array();
        $settingsLinks[] =  array(
					'linktype' => 'LISTVIEWSETTING',
					'linklabel' => vtranslate('LBL_WYSIWYG_CONFIG', $moduleName),
					'linkurl' => 'index.php?module=LSWYSIWYG&parent=Settings&view=Index',
					'linkicon' => ''
				);

		return $settingsLinks;
	}
}
