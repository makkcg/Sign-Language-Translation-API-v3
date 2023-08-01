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
$accounts_add = new accounts_add();

// Run the page
$accounts_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$accounts_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var faccountsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	faccountsadd = currentForm = new ew.Form("faccountsadd", "add");

	// Validate form
	faccountsadd.validate = function() {
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
			<?php if ($accounts_add->user_id->Required) { ?>
				elm = this.getElements("x" + infix + "_user_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->user_id->caption(), $accounts_add->user_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_user_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_add->user_id->errorMessage()) ?>");
			<?php if ($accounts_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->name->caption(), $accounts_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accounts_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->_email->caption(), $accounts_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accounts_add->phone->Required) { ?>
				elm = this.getElements("x" + infix + "_phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->phone->caption(), $accounts_add->phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accounts_add->words->Required) { ?>
				elm = this.getElements("x" + infix + "_words");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->words->caption(), $accounts_add->words->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_words");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_add->words->errorMessage()) ?>");
			<?php if ($accounts_add->used_words->Required) { ?>
				elm = this.getElements("x" + infix + "_used_words");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->used_words->caption(), $accounts_add->used_words->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_used_words");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_add->used_words->errorMessage()) ?>");
			<?php if ($accounts_add->remain_words->Required) { ?>
				elm = this.getElements("x" + infix + "_remain_words");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->remain_words->caption(), $accounts_add->remain_words->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_remain_words");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_add->remain_words->errorMessage()) ?>");
			<?php if ($accounts_add->connection_points->Required) { ?>
				elm = this.getElements("x" + infix + "_connection_points");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->connection_points->caption(), $accounts_add->connection_points->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_connection_points");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_add->connection_points->errorMessage()) ?>");
			<?php if ($accounts_add->package->Required) { ?>
				elm = this.getElements("x" + infix + "_package");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->package->caption(), $accounts_add->package->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accounts_add->expire_date->Required) { ?>
				elm = this.getElements("x" + infix + "_expire_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accounts_add->expire_date->caption(), $accounts_add->expire_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_expire_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accounts_add->expire_date->errorMessage()) ?>");

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
	faccountsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faccountsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	faccountsadd.lists["x_package"] = <?php echo $accounts_add->package->Lookup->toClientList($accounts_add) ?>;
	faccountsadd.lists["x_package"].options = <?php echo JsonEncode($accounts_add->package->lookupOptions()) ?>;
	loadjs.done("faccountsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $accounts_add->showPageHeader(); ?>
<?php
$accounts_add->showMessage();
?>
<form name="faccountsadd" id="faccountsadd" class="<?php echo $accounts_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="accounts">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$accounts_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($accounts_add->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label id="elh_accounts_user_id" for="x_user_id" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->user_id->caption() ?><?php echo $accounts_add->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->user_id->cellAttributes() ?>>
<span id="el_accounts_user_id">
<input type="text" data-table="accounts" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($accounts_add->user_id->getPlaceHolder()) ?>" value="<?php echo $accounts_add->user_id->EditValue ?>"<?php echo $accounts_add->user_id->editAttributes() ?>>
</span>
<?php echo $accounts_add->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_accounts_name" for="x_name" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->name->caption() ?><?php echo $accounts_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->name->cellAttributes() ?>>
<span id="el_accounts_name">
<input type="text" data-table="accounts" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($accounts_add->name->getPlaceHolder()) ?>" value="<?php echo $accounts_add->name->EditValue ?>"<?php echo $accounts_add->name->editAttributes() ?>>
</span>
<?php echo $accounts_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_accounts__email" for="x__email" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->_email->caption() ?><?php echo $accounts_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->_email->cellAttributes() ?>>
<span id="el_accounts__email">
<input type="text" data-table="accounts" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($accounts_add->_email->getPlaceHolder()) ?>" value="<?php echo $accounts_add->_email->EditValue ?>"<?php echo $accounts_add->_email->editAttributes() ?>>
</span>
<?php echo $accounts_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_add->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group row">
		<label id="elh_accounts_phone" for="x_phone" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->phone->caption() ?><?php echo $accounts_add->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->phone->cellAttributes() ?>>
<span id="el_accounts_phone">
<input type="text" data-table="accounts" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($accounts_add->phone->getPlaceHolder()) ?>" value="<?php echo $accounts_add->phone->EditValue ?>"<?php echo $accounts_add->phone->editAttributes() ?>>
</span>
<?php echo $accounts_add->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_add->words->Visible) { // words ?>
	<div id="r_words" class="form-group row">
		<label id="elh_accounts_words" for="x_words" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->words->caption() ?><?php echo $accounts_add->words->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->words->cellAttributes() ?>>
<span id="el_accounts_words">
<input type="text" data-table="accounts" data-field="x_words" name="x_words" id="x_words" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($accounts_add->words->getPlaceHolder()) ?>" value="<?php echo $accounts_add->words->EditValue ?>"<?php echo $accounts_add->words->editAttributes() ?>>
</span>
<?php echo $accounts_add->words->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_add->used_words->Visible) { // used_words ?>
	<div id="r_used_words" class="form-group row">
		<label id="elh_accounts_used_words" for="x_used_words" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->used_words->caption() ?><?php echo $accounts_add->used_words->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->used_words->cellAttributes() ?>>
<span id="el_accounts_used_words">
<input type="text" data-table="accounts" data-field="x_used_words" name="x_used_words" id="x_used_words" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($accounts_add->used_words->getPlaceHolder()) ?>" value="<?php echo $accounts_add->used_words->EditValue ?>"<?php echo $accounts_add->used_words->editAttributes() ?>>
</span>
<?php echo $accounts_add->used_words->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_add->remain_words->Visible) { // remain_words ?>
	<div id="r_remain_words" class="form-group row">
		<label id="elh_accounts_remain_words" for="x_remain_words" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->remain_words->caption() ?><?php echo $accounts_add->remain_words->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->remain_words->cellAttributes() ?>>
<span id="el_accounts_remain_words">
<input type="text" data-table="accounts" data-field="x_remain_words" name="x_remain_words" id="x_remain_words" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($accounts_add->remain_words->getPlaceHolder()) ?>" value="<?php echo $accounts_add->remain_words->EditValue ?>"<?php echo $accounts_add->remain_words->editAttributes() ?>>
</span>
<?php echo $accounts_add->remain_words->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_add->connection_points->Visible) { // connection_points ?>
	<div id="r_connection_points" class="form-group row">
		<label id="elh_accounts_connection_points" for="x_connection_points" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->connection_points->caption() ?><?php echo $accounts_add->connection_points->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->connection_points->cellAttributes() ?>>
<span id="el_accounts_connection_points">
<input type="text" data-table="accounts" data-field="x_connection_points" name="x_connection_points" id="x_connection_points" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($accounts_add->connection_points->getPlaceHolder()) ?>" value="<?php echo $accounts_add->connection_points->EditValue ?>"<?php echo $accounts_add->connection_points->editAttributes() ?>>
</span>
<?php echo $accounts_add->connection_points->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_add->package->Visible) { // package ?>
	<div id="r_package" class="form-group row">
		<label id="elh_accounts_package" for="x_package" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->package->caption() ?><?php echo $accounts_add->package->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->package->cellAttributes() ?>>
<span id="el_accounts_package">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($accounts_add->package->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $accounts_add->package->ViewValue ?></button>
		<div id="dsl_x_package" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $accounts_add->package->radioButtonListHtml(TRUE, "x_package") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_package" class="ew-template"><input type="radio" class="custom-control-input" data-table="accounts" data-field="x_package" data-value-separator="<?php echo $accounts_add->package->displayValueSeparatorAttribute() ?>" name="x_package" id="x_package" value="{value}"<?php echo $accounts_add->package->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$accounts_add->package->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $accounts_add->package->Lookup->getParamTag($accounts_add, "p_x_package") ?>
</span>
<?php echo $accounts_add->package->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accounts_add->expire_date->Visible) { // expire_date ?>
	<div id="r_expire_date" class="form-group row">
		<label id="elh_accounts_expire_date" for="x_expire_date" class="<?php echo $accounts_add->LeftColumnClass ?>"><?php echo $accounts_add->expire_date->caption() ?><?php echo $accounts_add->expire_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accounts_add->RightColumnClass ?>"><div <?php echo $accounts_add->expire_date->cellAttributes() ?>>
<span id="el_accounts_expire_date">
<input type="text" data-table="accounts" data-field="x_expire_date" name="x_expire_date" id="x_expire_date" maxlength="10" placeholder="<?php echo HtmlEncode($accounts_add->expire_date->getPlaceHolder()) ?>" value="<?php echo $accounts_add->expire_date->EditValue ?>"<?php echo $accounts_add->expire_date->editAttributes() ?>>
<?php if (!$accounts_add->expire_date->ReadOnly && !$accounts_add->expire_date->Disabled && !isset($accounts_add->expire_date->EditAttrs["readonly"]) && !isset($accounts_add->expire_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["faccountsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("faccountsadd", "x_expire_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $accounts_add->expire_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$accounts_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $accounts_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $accounts_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$accounts_add->showPageFooter();
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
$accounts_add->terminate();
?>