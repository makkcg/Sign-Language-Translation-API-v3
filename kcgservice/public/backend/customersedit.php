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
$customers_edit = new customers_edit();

// Run the page
$customers_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcustomersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcustomersedit = currentForm = new ew.Form("fcustomersedit", "edit");

	// Validate form
	fcustomersedit.validate = function() {
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
			<?php if ($customers_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->id->caption(), $customers_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->customer_id->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_id->caption(), $customers_edit->customer_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_customer_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($customers_edit->customer_id->errorMessage()) ?>");
			<?php if ($customers_edit->customer_name->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->customer_name->caption(), $customers_edit->customer_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->current_package->Required) { ?>
				elm = this.getElements("x" + infix + "_current_package");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->current_package->caption(), $customers_edit->current_package->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->remaine_words->Required) { ?>
				elm = this.getElements("x" + infix + "_remaine_words");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->remaine_words->caption(), $customers_edit->remaine_words->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_edit->expiration->Required) { ?>
				elm = this.getElements("x" + infix + "_expiration");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_edit->expiration->caption(), $customers_edit->expiration->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_expiration");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($customers_edit->expiration->errorMessage()) ?>");

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
	fcustomersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcustomersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcustomersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $customers_edit->showPageHeader(); ?>
<?php
$customers_edit->showMessage();
?>
<form name="fcustomersedit" id="fcustomersedit" class="<?php echo $customers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$customers_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($customers_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_customers_id" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->id->caption() ?><?php echo $customers_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->id->cellAttributes() ?>>
<span id="el_customers_id">
<span<?php echo $customers_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($customers_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="customers" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($customers_edit->id->CurrentValue) ?>">
<?php echo $customers_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_id->Visible) { // customer_id ?>
	<div id="r_customer_id" class="form-group row">
		<label id="elh_customers_customer_id" for="x_customer_id" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_id->caption() ?><?php echo $customers_edit->customer_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_id->cellAttributes() ?>>
<span id="el_customers_customer_id">
<input type="text" data-table="customers" data-field="x_customer_id" name="x_customer_id" id="x_customer_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($customers_edit->customer_id->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_id->EditValue ?>"<?php echo $customers_edit->customer_id->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->customer_name->Visible) { // customer_name ?>
	<div id="r_customer_name" class="form-group row">
		<label id="elh_customers_customer_name" for="x_customer_name" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->customer_name->caption() ?><?php echo $customers_edit->customer_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->customer_name->cellAttributes() ?>>
<span id="el_customers_customer_name">
<input type="text" data-table="customers" data-field="x_customer_name" name="x_customer_name" id="x_customer_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($customers_edit->customer_name->getPlaceHolder()) ?>" value="<?php echo $customers_edit->customer_name->EditValue ?>"<?php echo $customers_edit->customer_name->editAttributes() ?>>
</span>
<?php echo $customers_edit->customer_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->current_package->Visible) { // current_package ?>
	<div id="r_current_package" class="form-group row">
		<label id="elh_customers_current_package" for="x_current_package" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->current_package->caption() ?><?php echo $customers_edit->current_package->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->current_package->cellAttributes() ?>>
<span id="el_customers_current_package">
<input type="text" data-table="customers" data-field="x_current_package" name="x_current_package" id="x_current_package" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($customers_edit->current_package->getPlaceHolder()) ?>" value="<?php echo $customers_edit->current_package->EditValue ?>"<?php echo $customers_edit->current_package->editAttributes() ?>>
</span>
<?php echo $customers_edit->current_package->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->remaine_words->Visible) { // remaine_words ?>
	<div id="r_remaine_words" class="form-group row">
		<label id="elh_customers_remaine_words" for="x_remaine_words" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->remaine_words->caption() ?><?php echo $customers_edit->remaine_words->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->remaine_words->cellAttributes() ?>>
<span id="el_customers_remaine_words">
<input type="text" data-table="customers" data-field="x_remaine_words" name="x_remaine_words" id="x_remaine_words" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($customers_edit->remaine_words->getPlaceHolder()) ?>" value="<?php echo $customers_edit->remaine_words->EditValue ?>"<?php echo $customers_edit->remaine_words->editAttributes() ?>>
</span>
<?php echo $customers_edit->remaine_words->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_edit->expiration->Visible) { // expiration ?>
	<div id="r_expiration" class="form-group row">
		<label id="elh_customers_expiration" for="x_expiration" class="<?php echo $customers_edit->LeftColumnClass ?>"><?php echo $customers_edit->expiration->caption() ?><?php echo $customers_edit->expiration->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_edit->RightColumnClass ?>"><div <?php echo $customers_edit->expiration->cellAttributes() ?>>
<span id="el_customers_expiration">
<input type="text" data-table="customers" data-field="x_expiration" name="x_expiration" id="x_expiration" maxlength="19" placeholder="<?php echo HtmlEncode($customers_edit->expiration->getPlaceHolder()) ?>" value="<?php echo $customers_edit->expiration->EditValue ?>"<?php echo $customers_edit->expiration->editAttributes() ?>>
<?php if (!$customers_edit->expiration->ReadOnly && !$customers_edit->expiration->Disabled && !isset($customers_edit->expiration->EditAttrs["readonly"]) && !isset($customers_edit->expiration->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcustomersedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcustomersedit", "x_expiration", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $customers_edit->expiration->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$customers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $customers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$customers_edit->showPageFooter();
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
$customers_edit->terminate();
?>