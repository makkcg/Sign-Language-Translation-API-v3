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
$packags_add = new packags_add();

// Run the page
$packags_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$packags_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpackagsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpackagsadd = currentForm = new ew.Form("fpackagsadd", "add");

	// Validate form
	fpackagsadd.validate = function() {
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
			<?php if ($packags_add->package->Required) { ?>
				elm = this.getElements("x" + infix + "_package");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $packags_add->package->caption(), $packags_add->package->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($packags_add->number_of_words->Required) { ?>
				elm = this.getElements("x" + infix + "_number_of_words");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $packags_add->number_of_words->caption(), $packags_add->number_of_words->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_number_of_words");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($packags_add->number_of_words->errorMessage()) ?>");
			<?php if ($packags_add->period_in_months->Required) { ?>
				elm = this.getElements("x" + infix + "_period_in_months");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $packags_add->period_in_months->caption(), $packags_add->period_in_months->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_period_in_months");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($packags_add->period_in_months->errorMessage()) ?>");
			<?php if ($packags_add->connection_points->Required) { ?>
				elm = this.getElements("x" + infix + "_connection_points");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $packags_add->connection_points->caption(), $packags_add->connection_points->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_connection_points");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($packags_add->connection_points->errorMessage()) ?>");
			<?php if ($packags_add->price->Required) { ?>
				elm = this.getElements("x" + infix + "_price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $packags_add->price->caption(), $packags_add->price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_price");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($packags_add->price->errorMessage()) ?>");
			<?php if ($packags_add->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $packags_add->created_at->caption(), $packags_add->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($packags_add->created_at->errorMessage()) ?>");
			<?php if ($packags_add->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $packags_add->updated_at->caption(), $packags_add->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($packags_add->updated_at->errorMessage()) ?>");

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
	fpackagsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpackagsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpackagsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $packags_add->showPageHeader(); ?>
<?php
$packags_add->showMessage();
?>
<form name="fpackagsadd" id="fpackagsadd" class="<?php echo $packags_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="packags">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$packags_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($packags_add->package->Visible) { // package ?>
	<div id="r_package" class="form-group row">
		<label id="elh_packags_package" for="x_package" class="<?php echo $packags_add->LeftColumnClass ?>"><?php echo $packags_add->package->caption() ?><?php echo $packags_add->package->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $packags_add->RightColumnClass ?>"><div <?php echo $packags_add->package->cellAttributes() ?>>
<span id="el_packags_package">
<input type="text" data-table="packags" data-field="x_package" name="x_package" id="x_package" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($packags_add->package->getPlaceHolder()) ?>" value="<?php echo $packags_add->package->EditValue ?>"<?php echo $packags_add->package->editAttributes() ?>>
</span>
<?php echo $packags_add->package->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($packags_add->number_of_words->Visible) { // number_of_words ?>
	<div id="r_number_of_words" class="form-group row">
		<label id="elh_packags_number_of_words" for="x_number_of_words" class="<?php echo $packags_add->LeftColumnClass ?>"><?php echo $packags_add->number_of_words->caption() ?><?php echo $packags_add->number_of_words->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $packags_add->RightColumnClass ?>"><div <?php echo $packags_add->number_of_words->cellAttributes() ?>>
<span id="el_packags_number_of_words">
<input type="text" data-table="packags" data-field="x_number_of_words" name="x_number_of_words" id="x_number_of_words" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($packags_add->number_of_words->getPlaceHolder()) ?>" value="<?php echo $packags_add->number_of_words->EditValue ?>"<?php echo $packags_add->number_of_words->editAttributes() ?>>
</span>
<?php echo $packags_add->number_of_words->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($packags_add->period_in_months->Visible) { // period_in_months ?>
	<div id="r_period_in_months" class="form-group row">
		<label id="elh_packags_period_in_months" for="x_period_in_months" class="<?php echo $packags_add->LeftColumnClass ?>"><?php echo $packags_add->period_in_months->caption() ?><?php echo $packags_add->period_in_months->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $packags_add->RightColumnClass ?>"><div <?php echo $packags_add->period_in_months->cellAttributes() ?>>
<span id="el_packags_period_in_months">
<input type="text" data-table="packags" data-field="x_period_in_months" name="x_period_in_months" id="x_period_in_months" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($packags_add->period_in_months->getPlaceHolder()) ?>" value="<?php echo $packags_add->period_in_months->EditValue ?>"<?php echo $packags_add->period_in_months->editAttributes() ?>>
</span>
<?php echo $packags_add->period_in_months->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($packags_add->connection_points->Visible) { // connection_points ?>
	<div id="r_connection_points" class="form-group row">
		<label id="elh_packags_connection_points" for="x_connection_points" class="<?php echo $packags_add->LeftColumnClass ?>"><?php echo $packags_add->connection_points->caption() ?><?php echo $packags_add->connection_points->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $packags_add->RightColumnClass ?>"><div <?php echo $packags_add->connection_points->cellAttributes() ?>>
<span id="el_packags_connection_points">
<input type="text" data-table="packags" data-field="x_connection_points" name="x_connection_points" id="x_connection_points" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($packags_add->connection_points->getPlaceHolder()) ?>" value="<?php echo $packags_add->connection_points->EditValue ?>"<?php echo $packags_add->connection_points->editAttributes() ?>>
</span>
<?php echo $packags_add->connection_points->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($packags_add->price->Visible) { // price ?>
	<div id="r_price" class="form-group row">
		<label id="elh_packags_price" for="x_price" class="<?php echo $packags_add->LeftColumnClass ?>"><?php echo $packags_add->price->caption() ?><?php echo $packags_add->price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $packags_add->RightColumnClass ?>"><div <?php echo $packags_add->price->cellAttributes() ?>>
<span id="el_packags_price">
<input type="text" data-table="packags" data-field="x_price" name="x_price" id="x_price" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($packags_add->price->getPlaceHolder()) ?>" value="<?php echo $packags_add->price->EditValue ?>"<?php echo $packags_add->price->editAttributes() ?>>
</span>
<?php echo $packags_add->price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($packags_add->created_at->Visible) { // created_at ?>
	<div id="r_created_at" class="form-group row">
		<label id="elh_packags_created_at" for="x_created_at" class="<?php echo $packags_add->LeftColumnClass ?>"><?php echo $packags_add->created_at->caption() ?><?php echo $packags_add->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $packags_add->RightColumnClass ?>"><div <?php echo $packags_add->created_at->cellAttributes() ?>>
<span id="el_packags_created_at">
<input type="text" data-table="packags" data-field="x_created_at" name="x_created_at" id="x_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($packags_add->created_at->getPlaceHolder()) ?>" value="<?php echo $packags_add->created_at->EditValue ?>"<?php echo $packags_add->created_at->editAttributes() ?>>
<?php if (!$packags_add->created_at->ReadOnly && !$packags_add->created_at->Disabled && !isset($packags_add->created_at->EditAttrs["readonly"]) && !isset($packags_add->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpackagsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpackagsadd", "x_created_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $packags_add->created_at->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($packags_add->updated_at->Visible) { // updated_at ?>
	<div id="r_updated_at" class="form-group row">
		<label id="elh_packags_updated_at" for="x_updated_at" class="<?php echo $packags_add->LeftColumnClass ?>"><?php echo $packags_add->updated_at->caption() ?><?php echo $packags_add->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $packags_add->RightColumnClass ?>"><div <?php echo $packags_add->updated_at->cellAttributes() ?>>
<span id="el_packags_updated_at">
<input type="text" data-table="packags" data-field="x_updated_at" name="x_updated_at" id="x_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($packags_add->updated_at->getPlaceHolder()) ?>" value="<?php echo $packags_add->updated_at->EditValue ?>"<?php echo $packags_add->updated_at->editAttributes() ?>>
<?php if (!$packags_add->updated_at->ReadOnly && !$packags_add->updated_at->Disabled && !isset($packags_add->updated_at->EditAttrs["readonly"]) && !isset($packags_add->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpackagsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpackagsadd", "x_updated_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $packags_add->updated_at->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$packags_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $packags_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $packags_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$packags_add->showPageFooter();
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
$packags_add->terminate();
?>