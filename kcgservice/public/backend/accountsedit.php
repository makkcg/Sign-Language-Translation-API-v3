<?php
namespace PHPMaker2020\signwords;

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
$accounts_edit = new accounts_edit();

// Run the page
$accounts_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$accounts_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var faccountsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	faccountsedit = currentForm = new ew.Form("faccountsedit", "edit");

	// Validate form
	faccountsedit.validate = function() {
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
			<?php if ($accounts_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->id->caption(), $accounts_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accounts_edit->user_id->Required) { ?>
				elm = this.getElements("x" + infix + "_user_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->user_id->caption(), $accounts_edit->user_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_user_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_edit->user_id->errorMessage()) ?>");
			<?php if ($accounts_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->name->caption(), $accounts_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accounts_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->_email->caption(), $accounts_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accounts_edit->phone->Required) { ?>
				elm = this.getElements("x" + infix + "_phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->phone->caption(), $accounts_edit->phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accounts_edit->words->Required) { ?>
				elm = this.getElements("x" + infix + "_words");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->words->caption(), $accounts_edit->words->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_words");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_edit->words->errorMessage()) ?>");
			<?php if ($accounts_edit->used_words->Required) { ?>
				elm = this.getElements("x" + infix + "_used_words");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->used_words->caption(), $accounts_edit->used_words->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_used_words");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_edit->used_words->errorMessage()) ?>");
			<?php if ($accounts_edit->remain_words->Required) { ?>
				elm = this.getElements("x" + infix + "_remain_words");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->remain_words->caption(), $accounts_edit->remain_words->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_remain_words");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_edit->remain_words->errorMessage()) ?>");
			<?php if ($accounts_edit->connection_points->Required) { ?>
				elm = this.getElements("x" + infix + "_connection_points");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->connection_points->caption(), $accounts_edit->connection_points->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_connection_points");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_edit->connection_points->errorMessage()) ?>");
			<?php if ($accounts_edit->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->created_at->caption(), $accounts_edit->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_edit->created_at->errorMessage()) ?>");
			<?php if ($accounts_edit->package->Required) { ?>
				elm = this.getElements("x" + infix + "_package");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->package->caption(), $accounts_edit->package->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accounts_edit->expire_date->Required) { ?>
				elm = this.getElements("x" + infix + "_expire_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_edit->expire_date->caption(), $accounts_edit->expire_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_expire_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_edit->expire_date->errorMessage()) ?>");

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
	faccountsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faccountsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	faccountsedit.lists["x_package"] = <?php echo $accounts_edit->package->Lookup->toClientList($accounts_edit) ?>;
	faccountsedit.lists["x_package"].options = <?php echo JsonEncode($accounts_edit->package->lookupOptions()) ?>;
	loadjs.done("faccountsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $accounts_edit->showPageHeader(); ?>
<?php
$accounts_edit->showMessage();
?>
<form name="faccountsedit" id="faccountsedit" class="<?php echo $accounts_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="accounts">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$accounts_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($accounts_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_accounts_id" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->id->caption() ?><?php echo $accounts_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->id->cellAttributes() ?>>
<span id="el_accounts_id">
<span<?php echo $accounts_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accounts_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="accounts" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($accounts_edit->id->CurrentValue) ?>">
<?php echo $accounts_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label id="elh_accounts_user_id" for="x_user_id" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->user_id->caption() ?><?php echo $accounts_edit->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->user_id->cellAttributes() ?>>
<span id="el_accounts_user_id">
<input type="text" data-table="accounts" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($accounts_edit->user_id->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->user_id->EditValue ?>"<?php echo $accounts_edit->user_id->editAttributes() ?>>
</span>
<?php echo $accounts_edit->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_accounts_name" for="x_name" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->name->caption() ?><?php echo $accounts_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->name->cellAttributes() ?>>
<span id="el_accounts_name">
<input type="text" data-table="accounts" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($accounts_edit->name->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->name->EditValue ?>"<?php echo $accounts_edit->name->editAttributes() ?>>
</span>
<?php echo $accounts_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_accounts__email" for="x__email" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->_email->caption() ?><?php echo $accounts_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->_email->cellAttributes() ?>>
<span id="el_accounts__email">
<input type="text" data-table="accounts" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($accounts_edit->_email->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->_email->EditValue ?>"<?php echo $accounts_edit->_email->editAttributes() ?>>
</span>
<?php echo $accounts_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group row">
		<label id="elh_accounts_phone" for="x_phone" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->phone->caption() ?><?php echo $accounts_edit->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->phone->cellAttributes() ?>>
<span id="el_accounts_phone">
<input type="text" data-table="accounts" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($accounts_edit->phone->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->phone->EditValue ?>"<?php echo $accounts_edit->phone->editAttributes() ?>>
</span>
<?php echo $accounts_edit->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->words->Visible) { // words ?>
	<div id="r_words" class="form-group row">
		<label id="elh_accounts_words" for="x_words" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->words->caption() ?><?php echo $accounts_edit->words->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->words->cellAttributes() ?>>
<span id="el_accounts_words">
<input type="text" data-table="accounts" data-field="x_words" name="x_words" id="x_words" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($accounts_edit->words->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->words->EditValue ?>"<?php echo $accounts_edit->words->editAttributes() ?>>
</span>
<?php echo $accounts_edit->words->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->used_words->Visible) { // used_words ?>
	<div id="r_used_words" class="form-group row">
		<label id="elh_accounts_used_words" for="x_used_words" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->used_words->caption() ?><?php echo $accounts_edit->used_words->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->used_words->cellAttributes() ?>>
<span id="el_accounts_used_words">
<input type="text" data-table="accounts" data-field="x_used_words" name="x_used_words" id="x_used_words" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($accounts_edit->used_words->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->used_words->EditValue ?>"<?php echo $accounts_edit->used_words->editAttributes() ?>>
</span>
<?php echo $accounts_edit->used_words->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->remain_words->Visible) { // remain_words ?>
	<div id="r_remain_words" class="form-group row">
		<label id="elh_accounts_remain_words" for="x_remain_words" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->remain_words->caption() ?><?php echo $accounts_edit->remain_words->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->remain_words->cellAttributes() ?>>
<span id="el_accounts_remain_words">
<input type="text" data-table="accounts" data-field="x_remain_words" name="x_remain_words" id="x_remain_words" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($accounts_edit->remain_words->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->remain_words->EditValue ?>"<?php echo $accounts_edit->remain_words->editAttributes() ?>>
</span>
<?php echo $accounts_edit->remain_words->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->connection_points->Visible) { // connection_points ?>
	<div id="r_connection_points" class="form-group row">
		<label id="elh_accounts_connection_points" for="x_connection_points" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->connection_points->caption() ?><?php echo $accounts_edit->connection_points->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->connection_points->cellAttributes() ?>>
<span id="el_accounts_connection_points">
<input type="text" data-table="accounts" data-field="x_connection_points" name="x_connection_points" id="x_connection_points" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($accounts_edit->connection_points->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->connection_points->EditValue ?>"<?php echo $accounts_edit->connection_points->editAttributes() ?>>
</span>
<?php echo $accounts_edit->connection_points->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->created_at->Visible) { // created_at ?>
	<div id="r_created_at" class="form-group row">
		<label id="elh_accounts_created_at" for="x_created_at" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->created_at->caption() ?><?php echo $accounts_edit->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->created_at->cellAttributes() ?>>
<span id="el_accounts_created_at">
<input type="text" data-table="accounts" data-field="x_created_at" name="x_created_at" id="x_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($accounts_edit->created_at->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->created_at->EditValue ?>"<?php echo $accounts_edit->created_at->editAttributes() ?>>
<?php if (!$accounts_edit->created_at->ReadOnly && !$accounts_edit->created_at->Disabled && !isset($accounts_edit->created_at->EditAttrs["readonly"]) && !isset($accounts_edit->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["faccountsedit", "datetimepicker"], function() {
	ew.createDateTimePicker("faccountsedit", "x_created_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $accounts_edit->created_at->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->package->Visible) { // package ?>
	<div id="r_package" class="form-group row">
		<label id="elh_accounts_package" for="x_package" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->package->caption() ?><?php echo $accounts_edit->package->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->package->cellAttributes() ?>>
<span id="el_accounts_package">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($accounts_edit->package->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $accounts_edit->package->ViewValue ?></button>
		<div id="dsl_x_package" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $accounts_edit->package->radioButtonListHtml(TRUE, "x_package") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_package" class="ew-template"><input type="radio" class="custom-control-input" data-table="accounts" data-field="x_package" data-value-separator="<?php echo $accounts_edit->package->displayValueSeparatorAttribute() ?>" name="x_package" id="x_package" value="{value}"<?php echo $accounts_edit->package->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$accounts_edit->package->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $accounts_edit->package->Lookup->getParamTag($accounts_edit, "p_x_package") ?>
</span>
<?php echo $accounts_edit->package->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_edit->expire_date->Visible) { // expire_date ?>
	<div id="r_expire_date" class="form-group row">
		<label id="elh_accounts_expire_date" for="x_expire_date" class="<?php echo $accounts_edit->LeftColumnClass ?>"><?php echo $accounts_edit->expire_date->caption() ?><?php echo $accounts_edit->expire_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_edit->RightColumnClass ?>"><div <?php echo $accounts_edit->expire_date->cellAttributes() ?>>
<span id="el_accounts_expire_date">
<input type="text" data-table="accounts" data-field="x_expire_date" name="x_expire_date" id="x_expire_date" maxlength="10" placeholder="<?php echo HtmlEncode($accounts_edit->expire_date->getPlaceHolder()) ?>" value="<?php echo $accounts_edit->expire_date->EditValue ?>"<?php echo $accounts_edit->expire_date->editAttributes() ?>>
<?php if (!$accounts_edit->expire_date->ReadOnly && !$accounts_edit->expire_date->Disabled && !isset($accounts_edit->expire_date->EditAttrs["readonly"]) && !isset($accounts_edit->expire_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["faccountsedit", "datetimepicker"], function() {
	ew.createDateTimePicker("faccountsedit", "x_expire_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $accounts_edit->expire_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$accounts_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $accounts_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $accounts_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$accounts_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$accounts_edit->terminate();
?>