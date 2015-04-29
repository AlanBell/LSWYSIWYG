{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is:  vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/
-->*}
{strip}

<div class="editViewContainer container-fluid">
        <div class="contents">
                <form id="EditLSWYSIWYG" class="form-horizontal">
                        <div class="widget_header row-fluid">
                                <div class="span8"><h3>{vtranslate('LBL_WYSIWYG_SETTINGS', $QUALIFIED_MODULE)}</h3>&nbsp;{vtranslate('LBL_WYSIWYG_CONFIG_DESCRIPTION', $QUALIFIED_MODULE)}</div>
                        </div>
                        <hr>
	              {foreach from=$MODULE_MODEL->getModules() key=modulename item=module}
                <div class="row-fluid">
                    <div class="control-group">
                        <label class="control-label">
                            {vtranslate($modulename)}
                        </label>
                    <div class="controls row-fluid">
                  
                      <div id="tabid{$module['tabid']}" class="modulebuttons btn-group" data-toggle="buttons">
                        <label class="btnon btn {if $module['enabled']}btn-primary active{/if}">
			  {vtranslate('LBL_MODULE_ON', $QUALIFIED_MODULE)}
                        </label>
                        <label class="btnoff btn {if !$module['enabled']}btn-primary active{/if}">
                          {vtranslate('LBL_MODULE_OFF', $QUALIFIED_MODULE)}
                        </label>
                      </div>
                    </div>
                {/foreach}

		</form>

	</div>
</div>
{literal}
<script>
$(".modulebuttons").click(function(e){
//activates or deactivates our link from a module
//we do an ajax call to our service and flip a module link
    tabid=$(this).attr('id');
    operation=$(this).find('.btnon').hasClass('active') ? 'disable':'enable';
    var params = {
            'module' : app.getModuleName(),
            'parent' : app.getParentModuleName(),
            'action' : 'LSWYSIWYGSaveAjax',
            'tabid' : tabid,
            'operation':operation
    }
    AppConnector.request(params).then(
            function(data) {                    
                    //something happened, should check the data and set the toggle accordingly
                    if(data.result.enabled){
                        $('#'+data.result.tabid + ' .btnon').addClass('active btn-primary');
                        $('#'+data.result.tabid + ' .btnoff').removeClass('active btn-primary');
                        Vtiger_Helper_Js.showMessage({text:app.vtranslate('JS_WYSIWYG_ACTIVATED'),type:'info'})
                    }else{
                        $('#'+data.result.tabid + ' .btnoff').addClass('active btn-primary');
                        $('#'+data.result.tabid + ' .btnon').removeClass('active btn-primary');
                        Vtiger_Helper_Js.showMessage({text:app.vtranslate('JS_WYSIWYG_DEACTIVATED'),type:'info'})
                    }
            },
            function(error,err){
                    //the call failed, don't update the toggle, maybe do a message box
                        Vtiger_Helper_Js.showMessage({text:app.vtranslate('CHANGE_FAILED'),type:'error'})
            }
    );
    e.preventDefault();
  });
</script>
{/literal}
{/strip}
