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
$payments_edit = new payments_edit();

// Run the page
$payments_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payments_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpaymentsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpaymentsedit = currentForm = new ew.Form("fpaymentsedit", "edit");

	// Validate form
	fpaymentsedit.validate = function() {
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
			<?php if ($payments_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_edit->id->caption(), $payments_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payments_edit->contract_no->Required) { ?>
				elm = this.getElements("x" + infix + "_contract_no");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_edit->contract_no->caption(), $payments_edit->contract_no->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_contract_no");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payments_edit->contract_no->errorMessage()) ?>");
			<?php if ($payments_edit->payment->Required) { ?>
				elm = this.getElements("x" + infix + "_payment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_edit->payment->caption(), $payments_edit->payment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_payment");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payments_edit->payment->errorMessage()) ?>");
			<?php if ($payments_edit->points->Required) { ?>
				elm = this.getElements("x" + infix + "_points");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_edit->points->caption(), $payments_edit->points->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_points");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payments_edit->points->errorMessage()) ?>");
			<?php if ($payments_edit->due_date->Required) { ?>
				elm = this.getElements("x" + infix + "_due_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_edit->due_date->caption(), $payments_edit->due_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_due_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payments_edit->due_date->errorMessage()) ?>");
			<?php if ($payments_edit->notes->Required) { ?>
				elm = this.getElements("x" + infix + "_notes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_edit->notes->caption(), $payments_edit->notes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payments_edit->payed->Required) { ?>
				elm = this.getElements("x" + infix + "_payed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payments_edit->payed->caption(), $payments_edit->payed->RequiredErrorMessage)) ?>");
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
	fpaymentsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpaymentsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpaymentsedit.lists["x_payed"] = <?php echo $payments_edit->payed->Lookup->toClientList($payments_edit) ?>;
	fpaymentsedit.lists["x_payed"].options = <?php echo JsonEncode($payments_edit->payed->options(FALSE, TRUE)) ?>;
	loadjs.done("fpaymentsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payments_edit->showPageHeader(); ?>
<?php
$payments_edit->showMessage();
?>
<form name="fpaymentsedit" id="fpaymentsedit" class="<?php echo $payments_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payments">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$payments_edit->IsModal ?>">
<?php if ($payments->getCurrentMasterTable() == "contracts") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="contracts">
<input type="hidden" name="fk_id" value="<?php echo $payments_edit->contract_no->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($payments_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_payments_id" class="<?php echo $payments_edit->LeftColumnClass ?>"><?php echo $payments_edit->id->caption() ?><?php echo $payments_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_edit->RightColumnClass ?>"><div <?php echo $payments_edit->id->cellAttributes() ?>>
<span id="el_payments_id">
<span<?php echo $payments_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payments_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="payments" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($payments_edit->id->CurrentValue) ?>">
<?php echo $payments_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_edit->contract_no->Visible) { // contract_no ?>
	<div id="r_contract_no" class="form-group row">
		<label id="elh_payments_contract_no" for="x_contract_no" class="<?php echo $payments_edit->LeftColumnClass ?>"><?php echo $payments_edit->contract_no->caption() ?><?php echo $payments_edit->contract_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_edit->RightColumnClass ?>"><div <?php echo $payments_edit->contract_no->cellAttributes() ?>>
<?php if ($payments_edit->contract_no->getSessionValue() != "") { ?>
<span id="el_payments_contract_no">
<span<?php echo $payments_edit->contract_no->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payments_edit->contract_no->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_contract_no" name="x_contract_no" value="<?php echo HtmlEncode($payments_edit->contract_no->CurrentValue) ?>">
<?php } else { ?>
<span id="el_payments_contract_no">
<input type="text" data-table="payments" data-field="x_contract_no" name="x_contract_no" id="x_contract_no" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payments_edit->contract_no->getPlaceHolder()) ?>" value="<?php echo $payments_edit->contract_no->EditValue ?>"<?php echo $payments_edit->contract_no->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $payments_edit->contract_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_edit->payment->Visible) { // payment ?>
	<div id="r_payment" class="form-group row">
		<label id="elh_payments_payment" for="x_payment" class="<?php echo $payments_edit->LeftColumnClass ?>"><?php echo $payments_edit->payment->caption() ?><?php echo $payments_edit->payment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_edit->RightColumnClass ?>"><div <?php echo $payments_edit->payment->cellAttributes() ?>>
<span id="el_payments_payment">
<input type="text" data-table="payments" data-field="x_payment" name="x_payment" id="x_payment" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payments_edit->payment->getPlaceHolder()) ?>" value="<?php echo $payments_edit->payment->EditValue ?>"<?php echo $payments_edit->payment->editAttributes() ?>>
</span>
<?php echo $payments_edit->payment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_edit->points->Visible) { // points ?>
	<div id="r_points" class="form-group row">
		<label id="elh_payments_points" for="x_points" class="<?php echo $payments_edit->LeftColumnClass ?>"><?php echo $payments_edit->points->caption() ?><?php echo $payments_edit->points->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_edit->RightColumnClass ?>"><div <?php echo $payments_edit->points->cellAttributes() ?>>
<span id="el_payments_points">
<input type="text" disabled data-table="payments" data-field="x_points" name="x_points" id="x_points" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payments_edit->points->getPlaceHolder()) ?>" value="<?php echo $payments_edit->points->EditValue ?>"<?php echo $payments_edit->points->editAttributes() ?>>
</span>
<?php echo $payments_edit->points->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_edit->due_date->Visible) { // due_date ?>
	<div id="r_due_date" class="form-group row">
		<label id="elh_payments_due_date" for="x_due_date" class="<?php echo $payments_edit->LeftColumnClass ?>"><?php echo $payments_edit->due_date->caption() ?><?php echo $payments_edit->due_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_edit->RightColumnClass ?>"><div <?php echo $payments_edit->due_date->cellAttributes() ?>>
<span id="el_payments_due_date">
<input type="text" data-table="payments" data-field="x_due_date" name="x_due_date" id="x_due_date" maxlength="19" placeholder="<?php echo HtmlEncode($payments_edit->due_date->getPlaceHolder()) ?>" value="<?php echo $payments_edit->due_date->EditValue ?>"<?php echo $payments_edit->due_date->editAttributes() ?>>
<?php if (!$payments_edit->due_date->ReadOnly && !$payments_edit->due_date->Disabled && !isset($payments_edit->due_date->EditAttrs["readonly"]) && !isset($payments_edit->due_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpaymentsedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpaymentsedit", "x_due_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $payments_edit->due_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_edit->notes->Visible) { // notes ?>
	<div id="r_notes" class="form-group row">
		<label id="elh_payments_notes" for="x_notes" class="<?php echo $payments_edit->LeftColumnClass ?>"><?php echo $payments_edit->notes->caption() ?><?php echo $payments_edit->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_edit->RightColumnClass ?>"><div <?php echo $payments_edit->notes->cellAttributes() ?>>
<span id="el_payments_notes">
<textarea data-table="payments" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($payments_edit->notes->getPlaceHolder()) ?>"<?php echo $payments_edit->notes->editAttributes() ?>><?php echo $payments_edit->notes->EditValue ?></textarea>
</span>
<?php echo $payments_edit->notes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payments_edit->payed->Visible) { // payed ?>
	<div id="r_payed" class="form-group row">
		<label id="elh_payments_payed" class="<?php echo $payments_edit->LeftColumnClass ?>"><?php echo $payments_edit->payed->caption() ?><?php echo $payments_edit->payed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payments_edit->RightColumnClass ?>"><div <?php echo $payments_edit->payed->cellAttributes() ?>>
<span id="el_payments_payed">
<div id="tp_x_payed" class="ew-template"><input type="radio" class="custom-control-input" data-table="payments" data-field="x_payed" data-value-separator="<?php echo $payments_edit->payed->displayValueSeparatorAttribute() ?>" name="x_payed" id="x_payed" value="{value}"<?php echo $payments_edit->payed->editAttributes() ?>></div>
<div id="dsl_x_payed" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $payments_edit->payed->radioButtonListHtml(FALSE, "x_payed") ?>
</div></div>
</span>
<?php echo $payments_edit->payed->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payments_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payments_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payments_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payments_edit->showPageFooter();
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
$payments_edit->terminate();
?>