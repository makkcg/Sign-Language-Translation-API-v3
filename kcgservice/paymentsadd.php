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
$payments_add = new payments_add();

// Run the page
$payments_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payments_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpaymentsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpaymentsadd = currentForm = new ew.Form("fpaymentsadd", "add");

	// Validate form
	fpaymentsadd.validate = function() {
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
			<?php if ($payments_add->contract_no->Required) { ?>
				elm = this.getElements("x" + infix + "_contract_no");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_add->contract_no->caption(), $payments_add->contract_no->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_contract_no");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payments_add->contract_no->errorMessage()) ?>");
			<?php if ($payments_add->payment->Required) { ?>
				elm = this.getElements("x" + infix + "_payment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_add->payment->caption(), $payments_add->payment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_payment");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payments_add->payment->errorMessage()) ?>");
			<?php if ($payments_add->points->Required) { ?>
				elm = this.getElements("x" + infix + "_points");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_add->points->caption(), $payments_add->points->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_points");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payments_add->points->errorMessage()) ?>");
			<?php if ($payments_add->due_date->Required) { ?>
				elm = this.getElements("x" + infix + "_due_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_add->due_date->caption(), $payments_add->due_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_due_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payments_add->due_date->errorMessage()) ?>");
			<?php if ($payments_add->notes->Required) { ?>
				elm = this.getElements("x" + infix + "_notes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_add->notes->caption(), $payments_add->notes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payments_add->payed->Required) { ?>
				elm = this.getElements("x" + infix + "_payed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_add->payed->caption(), $payments_add->payed->RequiredErrorMessage)) ?>");
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
	fpaymentsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpaymentsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpaymentsadd.lists["x_payed"] = <?php echo $payments_add->payed->Lookup->toClientList($payments_add) ?>;
	fpaymentsadd.lists["x_payed"].options = <?php echo JsonEncode($payments_add->payed->options(FALSE, TRUE)) ?>;
	loadjs.done("fpaymentsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payments_add->showPageHeader(); ?>
<?php
$payments_add->showMessage();
?>
<form name="fpaymentsadd" id="fpaymentsadd" class="<?php echo $payments_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payments">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$payments_add->IsModal ?>">
<?php if ($payments->getCurrentMasterTable() == "contracts") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="contracts">
<input type="hidden" name="fk_id" value="<?php echo $payments_add->contract_no->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($payments_add->contract_no->Visible) { // contract_no ?>
	<div id="r_contract_no" class="form-group row">
		<label id="elh_payments_contract_no" for="x_contract_no" class="<?php echo $payments_add->LeftColumnClass ?>"><?php echo $payments_add->contract_no->caption() ?><?php echo $payments_add->contract_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_add->RightColumnClass ?>"><div <?php echo $payments_add->contract_no->cellAttributes() ?>>
<?php if ($payments_add->contract_no->getSessionValue() != "") { ?>
<span id="el_payments_contract_no">
<span<?php echo $payments_add->contract_no->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payments_add->contract_no->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_contract_no" name="x_contract_no" value="<?php echo HtmlEncode($payments_add->contract_no->CurrentValue) ?>">
<?php } else { ?>
<span id="el_payments_contract_no">
<input type="text" data-table="payments" data-field="x_contract_no" name="x_contract_no" id="x_contract_no" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payments_add->contract_no->getPlaceHolder()) ?>" value="<?php echo $payments_add->contract_no->EditValue ?>"<?php echo $payments_add->contract_no->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $payments_add->contract_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_add->payment->Visible) { // payment ?>
	<div id="r_payment" class="form-group row">
		<label id="elh_payments_payment" for="x_payment" class="<?php echo $payments_add->LeftColumnClass ?>"><?php echo $payments_add->payment->caption() ?><?php echo $payments_add->payment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_add->RightColumnClass ?>"><div <?php echo $payments_add->payment->cellAttributes() ?>>
<span id="el_payments_payment">
<input type="text" data-table="payments" data-field="x_payment" name="x_payment" id="x_payment" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payments_add->payment->getPlaceHolder()) ?>" value="<?php echo $payments_add->payment->EditValue ?>"<?php echo $payments_add->payment->editAttributes() ?>>
</span>
<?php echo $payments_add->payment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_add->points->Visible) { // points ?>
	<div id="r_points" class="form-group row">
		<label id="elh_payments_points" for="x_points" class="<?php echo $payments_add->LeftColumnClass ?>"><?php echo $payments_add->points->caption() ?><?php echo $payments_add->points->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_add->RightColumnClass ?>"><div <?php echo $payments_add->points->cellAttributes() ?>>
<span id="el_payments_points">
<input type="text" disabled value="0" data-table="payments" data-field="x_points" name="x_points" id="x_points" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payments_add->points->getPlaceHolder()) ?>" value="<?php echo $payments_add->points->EditValue ?>"<?php echo $payments_add->points->editAttributes() ?>>
</span>
<?php echo $payments_add->points->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_add->due_date->Visible) { // due_date ?>
	<div id="r_due_date" class="form-group row">
		<label id="elh_payments_due_date" for="x_due_date" class="<?php echo $payments_add->LeftColumnClass ?>"><?php echo $payments_add->due_date->caption() ?><?php echo $payments_add->due_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_add->RightColumnClass ?>"><div <?php echo $payments_add->due_date->cellAttributes() ?>>
<span id="el_payments_due_date">
<input type="text" data-table="payments" data-field="x_due_date" name="x_due_date" id="x_due_date" maxlength="19" placeholder="<?php echo HtmlEncode($payments_add->due_date->getPlaceHolder()) ?>" value="<?php echo $payments_add->due_date->EditValue ?>"<?php echo $payments_add->due_date->editAttributes() ?>>
<?php if (!$payments_add->due_date->ReadOnly && !$payments_add->due_date->Disabled && !isset($payments_add->due_date->EditAttrs["readonly"]) && !isset($payments_add->due_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpaymentsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpaymentsadd", "x_due_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $payments_add->due_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_add->notes->Visible) { // notes ?>
	<div id="r_notes" class="form-group row">
		<label id="elh_payments_notes" for="x_notes" class="<?php echo $payments_add->LeftColumnClass ?>"><?php echo $payments_add->notes->caption() ?><?php echo $payments_add->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_add->RightColumnClass ?>"><div <?php echo $payments_add->notes->cellAttributes() ?>>
<span id="el_payments_notes">
<textarea data-table="payments" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($payments_add->notes->getPlaceHolder()) ?>"<?php echo $payments_add->notes->editAttributes() ?>><?php echo $payments_add->notes->EditValue ?></textarea>
</span>
<?php echo $payments_add->notes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_add->payed->Visible) { // payed ?>
	<div id="r_payed" class="form-group row">
		<label id="elh_payments_payed" class="<?php echo $payments_add->LeftColumnClass ?>"><?php echo $payments_add->payed->caption() ?><?php echo $payments_add->payed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_add->RightColumnClass ?>"><div <?php echo $payments_add->payed->cellAttributes() ?>>
<span id="el_payments_payed">
<div id="tp_x_payed" class="ew-template"><input type="radio" class="custom-control-input" data-table="payments" data-field="x_payed" data-value-separator="<?php echo $payments_add->payed->displayValueSeparatorAttribute() ?>" name="x_payed" id="x_payed" value="{value}"<?php echo $payments_add->payed->editAttributes() ?>></div>
<div id="dsl_x_payed" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $payments_add->payed->radioButtonListHtml(FALSE, "x_payed") ?>
</div></div>
</span>
<?php echo $payments_add->payed->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payments_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payments_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payments_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payments_add->showPageFooter();
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
$payments_add->terminate();
?>