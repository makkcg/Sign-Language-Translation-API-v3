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
$customers_add = new customers_add();

// Run the page
$customers_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcustomersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcustomersadd = currentForm = new ew.Form("fcustomersadd", "add");

	// Validate form
	fcustomersadd.validate = function() {
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
			<?php if ($customers_add->customer_id->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->customer_id->caption(), $customers_add->customer_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_customer_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($customers_add->customer_id->errorMessage()) ?>");
			<?php if ($customers_add->customer_name->Required) { ?>
				elm = this.getElements("x" + infix + "_customer_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->customer_name->caption(), $customers_add->customer_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->current_package->Required) { ?>
				elm = this.getElements("x" + infix + "_current_package");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->current_package->caption(), $customers_add->current_package->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->remaine_words->Required) { ?>
				elm = this.getElements("x" + infix + "_remaine_words");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->remaine_words->caption(), $customers_add->remaine_words->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($customers_add->expiration->Required) { ?>
				elm = this.getElements("x" + infix + "_expiration");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $customers_add->expiration->caption(), $customers_add->expiration->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_expiration");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($customers_add->expiration->errorMessage()) ?>");

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
	fcustomersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcustomersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcustomersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $customers_add->showPageHeader(); ?>
<?php
$customers_add->showMessage();
?>
<form name="fcustomersadd" id="fcustomersadd" class="<?php echo $customers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$customers_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($customers_add->customer_id->Visible) { // customer_id ?>
	<div id="r_customer_id" class="form-group row">
		<label id="elh_customers_customer_id" for="x_customer_id" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->customer_id->caption() ?><?php echo $customers_add->customer_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->customer_id->cellAttributes() ?>>
<span id="el_customers_customer_id">
<input type="text" data-table="customers" data-field="x_customer_id" name="x_customer_id" id="x_customer_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($customers_add->customer_id->getPlaceHolder()) ?>" value="<?php echo $customers_add->customer_id->EditValue ?>"<?php echo $customers_add->customer_id->editAttributes() ?>>
</span>
<?php echo $customers_add->customer_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->customer_name->Visible) { // customer_name ?>
	<div id="r_customer_name" class="form-group row">
		<label id="elh_customers_customer_name" for="x_customer_name" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->customer_name->caption() ?><?php echo $customers_add->customer_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->customer_name->cellAttributes() ?>>
<span id="el_customers_customer_name">
<input type="text" data-table="customers" data-field="x_customer_name" name="x_customer_name" id="x_customer_name" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($customers_add->customer_name->getPlaceHolder()) ?>" value="<?php echo $customers_add->customer_name->EditValue ?>"<?php echo $customers_add->customer_name->editAttributes() ?>>
</span>
<?php echo $customers_add->customer_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->current_package->Visible) { // current_package ?>
	<div id="r_current_package" class="form-group row">
		<label id="elh_customers_current_package" for="x_current_package" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->current_package->caption() ?><?php echo $customers_add->current_package->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->current_package->cellAttributes() ?>>
<span id="el_customers_current_package">
<input type="text" data-table="customers" data-field="x_current_package" name="x_current_package" id="x_current_package" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($customers_add->current_package->getPlaceHolder()) ?>" value="<?php echo $customers_add->current_package->EditValue ?>"<?php echo $customers_add->current_package->editAttributes() ?>>
</span>
<?php echo $customers_add->current_package->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->remaine_words->Visible) { // remaine_words ?>
	<div id="r_remaine_words" class="form-group row">
		<label id="elh_customers_remaine_words" for="x_remaine_words" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->remaine_words->caption() ?><?php echo $customers_add->remaine_words->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->remaine_words->cellAttributes() ?>>
<span id="el_customers_remaine_words">
<input type="text" data-table="customers" data-field="x_remaine_words" name="x_remaine_words" id="x_remaine_words" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($customers_add->remaine_words->getPlaceHolder()) ?>" value="<?php echo $customers_add->remaine_words->EditValue ?>"<?php echo $customers_add->remaine_words->editAttributes() ?>>
</span>
<?php echo $customers_add->remaine_words->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($customers_add->expiration->Visible) { // expiration ?>
	<div id="r_expiration" class="form-group row">
		<label id="elh_customers_expiration" for="x_expiration" class="<?php echo $customers_add->LeftColumnClass ?>"><?php echo $customers_add->expiration->caption() ?><?php echo $customers_add->expiration->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $customers_add->RightColumnClass ?>"><div <?php echo $customers_add->expiration->cellAttributes() ?>>
<span id="el_customers_expiration">
<input type="text" data-table="customers" data-field="x_expiration" name="x_expiration" id="x_expiration" maxlength="19" placeholder="<?php echo HtmlEncode($customers_add->expiration->getPlaceHolder()) ?>" value="<?php echo $customers_add->expiration->EditValue ?>"<?php echo $customers_add->expiration->editAttributes() ?>>
<?php if (!$customers_add->expiration->ReadOnly && !$customers_add->expiration->Disabled && !isset($customers_add->expiration->EditAttrs["readonly"]) && !isset($customers_add->expiration->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcustomersadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcustomersadd", "x_expiration", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $customers_add->expiration->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$customers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $customers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$customers_add->showPageFooter();
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
$customers_add->terminate();
?>