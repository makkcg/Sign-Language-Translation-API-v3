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
$news_edit = new news_edit();

// Run the page
$news_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$news_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fnewsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fnewsedit = currentForm = new ew.Form("fnewsedit", "edit");

	// Validate form
	fnewsedit.validate = function() {
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
			<?php if ($news_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $news_edit->id->caption(), $news_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($news_edit->title->Required) { ?>
				elm = this.getElements("x" + infix + "_title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $news_edit->title->caption(), $news_edit->title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($news_edit->image->Required) { ?>
				elm = this.getElements("x" + infix + "_image");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $news_edit->image->caption(), $news_edit->image->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($news_edit->report->Required) { ?>
				elm = this.getElements("x" + infix + "_report");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $news_edit->report->caption(), $news_edit->report->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($news_edit->created_at->Required) { ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $news_edit->created_at->caption(), $news_edit->created_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_created_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($news_edit->created_at->errorMessage()) ?>");
			<?php if ($news_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $news_edit->updated_at->caption(), $news_edit->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($news_edit->updated_at->errorMessage()) ?>");

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
	fnewsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fnewsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fnewsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $news_edit->showPageHeader(); ?>
<?php
$news_edit->showMessage();
?>
<form name="fnewsedit" id="fnewsedit" class="<?php echo $news_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="news">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$news_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($news_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_news_id" class="<?php echo $news_edit->LeftColumnClass ?>"><?php echo $news_edit->id->caption() ?><?php echo $news_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $news_edit->RightColumnClass ?>"><div <?php echo $news_edit->id->cellAttributes() ?>>
<span id="el_news_id">
<span<?php echo $news_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($news_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="news" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($news_edit->id->CurrentValue) ?>">
<?php echo $news_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news_edit->title->Visible) { // title ?>
	<div id="r_title" class="form-group row">
		<label id="elh_news_title" for="x_title" class="<?php echo $news_edit->LeftColumnClass ?>"><?php echo $news_edit->title->caption() ?><?php echo $news_edit->title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $news_edit->RightColumnClass ?>"><div <?php echo $news_edit->title->cellAttributes() ?>>
<span id="el_news_title">
<input type="text" data-table="news" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($news_edit->title->getPlaceHolder()) ?>" value="<?php echo $news_edit->title->EditValue ?>"<?php echo $news_edit->title->editAttributes() ?>>
</span>
<?php echo $news_edit->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news_edit->image->Visible) { // image ?>
	<div id="r_image" class="form-group row">
		<label id="elh_news_image" for="x_image" class="<?php echo $news_edit->LeftColumnClass ?>"><?php echo $news_edit->image->caption() ?><?php echo $news_edit->image->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $news_edit->RightColumnClass ?>"><div <?php echo $news_edit->image->cellAttributes() ?>>
<span id="el_news_image">
<input type="text" data-table="news" data-field="x_image" name="x_image" id="x_image" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($news_edit->image->getPlaceHolder()) ?>" value="<?php echo $news_edit->image->EditValue ?>"<?php echo $news_edit->image->editAttributes() ?>>
</span>
<?php echo $news_edit->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news_edit->report->Visible) { // report ?>
	<div id="r_report" class="form-group row">
		<label id="elh_news_report" for="x_report" class="<?php echo $news_edit->LeftColumnClass ?>"><?php echo $news_edit->report->caption() ?><?php echo $news_edit->report->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $news_edit->RightColumnClass ?>"><div <?php echo $news_edit->report->cellAttributes() ?>>
<span id="el_news_report">
<textarea data-table="news" data-field="x_report" name="x_report" id="x_report" cols="35" rows="4" placeholder="<?php echo HtmlEncode($news_edit->report->getPlaceHolder()) ?>"<?php echo $news_edit->report->editAttributes() ?>><?php echo $news_edit->report->EditValue ?></textarea>
</span>
<?php echo $news_edit->report->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news_edit->created_at->Visible) { // created_at ?>
	<div id="r_created_at" class="form-group row">
		<label id="elh_news_created_at" for="x_created_at" class="<?php echo $news_edit->LeftColumnClass ?>"><?php echo $news_edit->created_at->caption() ?><?php echo $news_edit->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $news_edit->RightColumnClass ?>"><div <?php echo $news_edit->created_at->cellAttributes() ?>>
<span id="el_news_created_at">
<input type="text" data-table="news" data-field="x_created_at" name="x_created_at" id="x_created_at" maxlength="19" placeholder="<?php echo HtmlEncode($news_edit->created_at->getPlaceHolder()) ?>" value="<?php echo $news_edit->created_at->EditValue ?>"<?php echo $news_edit->created_at->editAttributes() ?>>
<?php if (!$news_edit->created_at->ReadOnly && !$news_edit->created_at->Disabled && !isset($news_edit->created_at->EditAttrs["readonly"]) && !isset($news_edit->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnewsedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fnewsedit", "x_created_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $news_edit->created_at->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news_edit->updated_at->Visible) { // updated_at ?>
	<div id="r_updated_at" class="form-group row">
		<label id="elh_news_updated_at" for="x_updated_at" class="<?php echo $news_edit->LeftColumnClass ?>"><?php echo $news_edit->updated_at->caption() ?><?php echo $news_edit->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $news_edit->RightColumnClass ?>"><div <?php echo $news_edit->updated_at->cellAttributes() ?>>
<span id="el_news_updated_at">
<input type="text" data-table="news" data-field="x_updated_at" name="x_updated_at" id="x_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($news_edit->updated_at->getPlaceHolder()) ?>" value="<?php echo $news_edit->updated_at->EditValue ?>"<?php echo $news_edit->updated_at->editAttributes() ?>>
<?php if (!$news_edit->updated_at->ReadOnly && !$news_edit->updated_at->Disabled && !isset($news_edit->updated_at->EditAttrs["readonly"]) && !isset($news_edit->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnewsedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fnewsedit", "x_updated_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $news_edit->updated_at->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$news_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $news_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $news_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$news_edit->showPageFooter();
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
$news_edit->terminate();
?>