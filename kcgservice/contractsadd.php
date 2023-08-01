<?php
namespace PHPMaker2020\contracting;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$contracts_add = new contracts_add();

// Run the page
$contracts_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contracts_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcontractsadd = currentForm = new ew.Form("fcontractsadd", "add");

	// Validate form
	fcontractsadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($contracts_add->client_name->Required) { ?>
				elm = this.getElements("x" + infix + "_client_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contracts_add->client_name->caption(), $contracts_add->client_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contracts_add->package->Required) { ?>
				elm = this.getElements("x" + infix + "_package");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contracts_add->package->caption(), $contracts_add->package->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contracts_add->from_date->Required) { ?>
				elm = this.getElements("x" + infix + "_from_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contracts_add->from_date->caption(), $contracts_add->from_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_from_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contracts_add->from_date->errorMessage()) ?>");
			<?php if ($contracts_add->to_date->Required) { ?>
				elm = this.getElements("x" + infix + "_to_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contracts_add->to_date->caption(), $contracts_add->to_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_to_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contracts_add->to_date->errorMessage()) ?>");
			<?php if ($contracts_add->points->Required) { ?>
				elm = this.getElements("x" + infix + "_points");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contracts_add->points->caption(), $contracts_add->points->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_points");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contracts_add->points->errorMessage()) ?>");
			<?php if ($contracts_add->attach->Required) { ?>
				felm = this.getElements("x" + infix + "_attach");
				elm = this.getElements("fn_x" + infix + "_attach");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $contracts_add->attach->caption(), $contracts_add->attach->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fcontractsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontractsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontractsadd.lists["x_client_name"] = <?php echo $contracts_add->client_name->Lookup->toClientList($contracts_add) ?>;
	fcontractsadd.lists["x_client_name"].options = <?php echo JsonEncode($contracts_add->client_name->lookupOptions()) ?>;
	fcontractsadd.lists["x_package"] = <?php echo $contracts_add->package->Lookup->toClientList($contracts_add) ?>;
	fcontractsadd.lists["x_package"].options = <?php echo JsonEncode($contracts_add->package->lookupOptions()) ?>;
	loadjs.done("fcontractsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contracts_add->showPageHeader(); ?>
<?php
$contracts_add->showMessage();
?>
<form name="fcontractsadd" id="fcontractsadd" class="<?php echo $contracts_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contracts">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contracts_add->IsModal ?>">
<?php if ($contracts->getCurrentMasterTable() == "clients") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="clients">
<input type="hidden" name="fk_client_name" value="<?php echo $contracts_add->client_name->getSessionValue() ?>">
<?php } ?>
<?php if ($contracts->getCurrentMasterTable() == "packages") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="packages">
<input type="hidden" name="fk_package_name" value="<?php echo $contracts_add->package->getSessionValue() ?>">
<input type="hidden" name="fk_points" value="<?php echo $contracts_add->points->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($contracts_add->client_name->Visible) { // client_name ?>
	<div id="r_client_name" class="form-group row">
		<label id="elh_contracts_client_name" for="x_client_name" class="<?php echo $contracts_add->LeftColumnClass ?>"><?php echo $contracts_add->client_name->caption() ?><?php echo $contracts_add->client_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contracts_add->RightColumnClass ?>"><div <?php echo $contracts_add->client_name->cellAttributes() ?>>
<?php if ($contracts_add->client_name->getSessionValue() != "") { ?>
<span id="el_contracts_client_name">
<span<?php echo $contracts_add->client_name->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contracts_add->client_name->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_client_name" name="x_client_name" value="<?php echo HtmlEncode($contracts_add->client_name->CurrentValue) ?>">
<?php } else { ?>
<span id="el_contracts_client_name">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contracts" data-field="x_client_name" data-value-separator="<?php echo $contracts_add->client_name->displayValueSeparatorAttribute() ?>" id="x_client_name" name="x_client_name"<?php echo $contracts_add->client_name->editAttributes() ?>>
			<?php echo $contracts_add->client_name->selectOptionListHtml("x_client_name") ?>
		</select>
</div>
<?php echo $contracts_add->client_name->Lookup->getParamTag($contracts_add, "p_x_client_name") ?>
</span>
<?php } ?>
<?php echo $contracts_add->client_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contracts_add->package->Visible) { // package ?>
	<div id="r_package" class="form-group row">
		<label id="elh_contracts_package" for="x_package" class="<?php echo $contracts_add->LeftColumnClass ?>"><?php echo $contracts_add->package->caption() ?><?php echo $contracts_add->package->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contracts_add->RightColumnClass ?>"><div <?php echo $contracts_add->package->cellAttributes() ?>>
<?php if ($contracts_add->package->getSessionValue() != "") { ?>
<span id="el_contracts_package">
<span<?php echo $contracts_add->package->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contracts_add->package->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_package" name="x_package" value="<?php echo HtmlEncode($contracts_add->package->CurrentValue) ?>">
<?php } else { ?>
<span id="el_contracts_package">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contracts" data-field="x_package" data-value-separator="<?php echo $contracts_add->package->displayValueSeparatorAttribute() ?>" id="x_package" name="x_package"<?php echo $contracts_add->package->editAttributes() ?>>
			<?php echo $contracts_add->package->selectOptionListHtml("x_package") ?>
		</select>
</div>
<?php echo $contracts_add->package->Lookup->getParamTag($contracts_add, "p_x_package") ?>
</span>
<?php } ?>
<?php echo $contracts_add->package->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contracts_add->from_date->Visible) { // from_date ?>
	<div id="r_from_date" class="form-group row">
		<label id="elh_contracts_from_date" for="x_from_date" class="<?php echo $contracts_add->LeftColumnClass ?>"><?php echo $contracts_add->from_date->caption() ?><?php echo $contracts_add->from_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contracts_add->RightColumnClass ?>"><div <?php echo $contracts_add->from_date->cellAttributes() ?>>
<span id="el_contracts_from_date">
<input type="text" data-table="contracts" data-field="x_from_date" name="x_from_date" id="x_from_date" maxlength="19" placeholder="<?php echo HtmlEncode($contracts_add->from_date->getPlaceHolder()) ?>" value="<?php echo $contracts_add->from_date->EditValue ?>"<?php echo $contracts_add->from_date->editAttributes() ?>>
<?php if (!$contracts_add->from_date->ReadOnly && !$contracts_add->from_date->Disabled && !isset($contracts_add->from_date->EditAttrs["readonly"]) && !isset($contracts_add->from_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractsadd", "x_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contracts_add->from_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contracts_add->to_date->Visible) { // to_date ?>
	<div id="r_to_date" class="form-group row">
		<label id="elh_contracts_to_date" for="x_to_date" class="<?php echo $contracts_add->LeftColumnClass ?>"><?php echo $contracts_add->to_date->caption() ?><?php echo $contracts_add->to_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contracts_add->RightColumnClass ?>"><div <?php echo $contracts_add->to_date->cellAttributes() ?>>
<span id="el_contracts_to_date">
<input type="text" data-table="contracts" data-field="x_to_date" name="x_to_date" id="x_to_date" maxlength="19" placeholder="<?php echo HtmlEncode($contracts_add->to_date->getPlaceHolder()) ?>" value="<?php echo $contracts_add->to_date->EditValue ?>"<?php echo $contracts_add->to_date->editAttributes() ?>>
<?php if (!$contracts_add->to_date->ReadOnly && !$contracts_add->to_date->Disabled && !isset($contracts_add->to_date->EditAttrs["readonly"]) && !isset($contracts_add->to_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractsadd", "x_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contracts_add->to_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contracts_add->points->Visible) { // points ?>
	<div id="r_points" class="form-group row">
		<label id="elh_contracts_points" for="x_points" class="<?php echo $contracts_add->LeftColumnClass ?>"><?php echo $contracts_add->points->caption() ?><?php echo $contracts_add->points->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contracts_add->RightColumnClass ?>"><div <?php echo $contracts_add->points->cellAttributes() ?>>
<?php if ($contracts_add->points->getSessionValue() != "") { ?>
<span id="el_contracts_points">
<span<?php echo $contracts_add->points->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contracts_add->points->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_points" name="x_points" value="<?php echo HtmlEncode($contracts_add->points->CurrentValue) ?>">
<?php } else { ?>
<span id="el_contracts_points">
<input type="text" data-table="contracts" disabled data-field="x_points" name="x_points" id="x_points" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($contracts_add->points->getPlaceHolder()) ?>" value="<?php echo $contracts_add->points->EditValue ?>"<?php echo $contracts_add->points->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $contracts_add->points->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contracts_add->attach->Visible) { // attach ?>
	<div id="r_attach" class="form-group row">
		<label id="elh_contracts_attach" class="<?php echo $contracts_add->LeftColumnClass ?>"><?php echo $contracts_add->attach->caption() ?><?php echo $contracts_add->attach->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contracts_add->RightColumnClass ?>"><div <?php echo $contracts_add->attach->cellAttributes() ?>>
<span id="el_contracts_attach">
<div id="fd_x_attach">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $contracts_add->attach->title() ?>" data-table="contracts" data-field="x_attach" name="x_attach" id="x_attach" lang="<?php echo CurrentLanguageID() ?>"<?php echo $contracts_add->attach->editAttributes() ?><?php if ($contracts_add->attach->ReadOnly || $contracts_add->attach->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_attach"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_attach" id= "fn_x_attach" value="<?php echo $contracts_add->attach->Upload->FileName ?>">
<input type="hidden" name="fa_x_attach" id= "fa_x_attach" value="0">
<input type="hidden" name="fs_x_attach" id= "fs_x_attach" value="255">
<input type="hidden" name="fx_x_attach" id= "fx_x_attach" value="<?php echo $contracts_add->attach->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_attach" id= "fm_x_attach" value="<?php echo $contracts_add->attach->UploadMaxFileSize ?>">
</div>
<table id="ft_x_attach" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $contracts_add->attach->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("payments", explode(",", $contracts->getCurrentDetailTable())) && $payments->DetailAdd) {
?>
<?php if ($contracts->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("payments", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "paymentsgrid.php" ?>
<?php } ?>
<?php
	if (in_array("websites", explode(",", $contracts->getCurrentDetailTable())) && $websites->DetailAdd) {
?>
<?php if ($contracts->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("websites", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "websitesgrid.php" ?>
<?php } ?>
<?php if (!$contracts_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contracts_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contracts_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contracts_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

$("#x_package").change(function(){
if ($('#x_package').find(":selected").val().trim() != "")
{	
$.ajax({
                  url : '../techservice.php',
                  type : 'GET',	
				                  
				  async:true,
                  data : { 
				  order:4,
				  val1:$('#x_package').find(":selected").val().trim()
				  
				  },
					
             
                  success : function(data) {


			          $("#x_points").val(data);

                                  
				                            					
					   },
                   error : function(jqXHR, textStatus, error)
                                            {
												 
                                             }		 
											 
                       });
					   
}					   
     });
	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$contracts_add->terminate();
?>