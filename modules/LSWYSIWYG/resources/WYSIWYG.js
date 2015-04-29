var WYSIWYG={
  displaySelectWizard:function(massActionUrl,module){
  	var massActionUrl="index.php"
   	var listInstance = Vtiger_List_Js.getInstance();
	var validationResult = listInstance.checkListRecordSelected();
	if(validationResult != true){
	    var progressIndicatorElement = jQuery.progressIndicator();
	    // Compute selected ids, excluded ids values, along with cvid value and pass as url parameters
	    var selectedIds = listInstance.readSelectedIds(true);
	    var excludedIds = listInstance.readExcludedIds(true);
	    var cvId = listInstance.getCurrentCvId();
	    var postData = {
		"viewname" : cvId,
		"selected_ids":selectedIds,
		"excluded_ids" : excludedIds
	    };

	    var listViewInstance = Vtiger_List_Js.getInstance();
	    var searchValue = listViewInstance.getAlphabetSearchValue();

	    if((typeof searchValue != "undefined") && (searchValue.length > 0)) {
		postData['search_key'] = listViewInstance.getAlphabetSearchField();
		postData['search_value'] = searchValue;
		postData['operator'] = "s";
	    }

	    postData.search_params = JSON.stringify(listInstance.getListSearchParams());

	    var actionParams = {
		"type":"POST",
		"url":massActionUrl,
		"dataType":"application/x-msexcel",
		"data" : postData
	    };
    //can't use AppConnector to get files with a post request so we add a form to the body and submit it

		var form = $('<form method="POST" action="' + massActionUrl + '">');
    form.append($('<input />', {  name: "module", value:"LSWYSIWYG" }));
    form.append($('<input />', {  name: "targetmodule", value:app.getModuleName() }));
    form.append($('<input />', {  name: "action", value:"ViewToSheet" }));
    if(typeof csrfMagicName !== 'undefined'){
      form.append($('<input />', {  name: csrfMagicName, value:csrfMagicToken}));
    }
    $.each(actionParams.data, function(k, v) {
	      form.append($('<input />', {  name: k, value:v }));
	  });
		$('body').append(form);
		form.submit();
                        Vtiger_Helper_Js.showMessage({text:'Making your spreadsheet . . .',type:'info'})

    progressIndicatorElement.progressIndicator({'mode' : 'hide'});

	    } else {
	    listInstance.noRecordSelectedAlert();
	}
    }
}
