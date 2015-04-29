<?php
class Settings_LSWYSIWYG_LSWYSIWYGSaveAjax_Action extends Settings_Vtiger_Basic_Action {

        public function process(Vtiger_Request $request) {
                $response = new Vtiger_Response();
                $qualifiedModuleName = $request->getModule(false);
                $tabid = str_replace('tabid','',$request->get('tabid'));
                $operation = $request->get('operation');
                $moduleModel = Settings_LSWYSIWYG_Module_Model::getInstance();
                if ($tabid) {
                    //we are toggling a tabid, and returning the current status of that tab
                    if($operation=="enable"){//if it is on at the moment we delete it
                        Vtiger_Link::addLink($tabid, 'LISTVIEW', "WYSIWYG", 'javascript:WYSIWYG.displaySelectWizard(this, \'$MODULE$\');','','','');
                        $result=true;
                    }else{
                        Vtiger_Link::deleteLink($tabid, 'LISTVIEW', 'WYSIWYG');
                        $result=false;
                    }
                   $response->setResult(array('tabid'=>"tabid$tabid",'enabled'=>$result));  
                } else {
                    $response->setError(vtranslate('Failed to enable', $qualifiedModuleName));
                }
                $response->emit();

        }
}

