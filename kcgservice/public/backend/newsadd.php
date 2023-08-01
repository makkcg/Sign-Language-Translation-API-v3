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
$news_add = new news_add();

// Run the page
$news_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$news_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fnewsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fnewsadd = currentForm = new ew.Form("fnewsadd", "add");

	// Validate form
	fnewsadd.validate = function() {
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
			<?php if ($news_add->title->Required) { ?>
				elm = this.getElements("x" + infix + "_title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $news_add->title->caption(), $news_add->title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($news_add->image->Required) { ?>
				elm = this.getElements("x" + infix + "_image");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $news_add->image->caption(), $news_add->image->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($news_add->report->Required) { ?>
				elm = this.getElements("x" + infix + "_report");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $news_add->report->caption(), $news_add->report->RequiredErrorMessage)) ?>");
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
	fnewsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fnewsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fnewsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $news_add->showPageHeader(); ?>
<?php
$news_add->showMessage();
?>
<form name="fnewsadd" id="fnewsadd" class="<?php echo $news_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="news">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$news_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($news_add->title->Visible) { // title ?>
	<div id="r_title" class="form-group row">
		<label id="elh_news_title" for="x_title" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news_add->title->caption() ?><?php echo $news_add->title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div <?php echo $news_add->title->cellAttributes() ?>>
<span id="el_news_title">
<input type="text" data-table="news" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($news_add->title->getPlaceHolder()) ?>" value="<?php echo $news_add->title->EditValue ?>"<?php echo $news_add->title->editAttributes() ?>>
</span>
<?php echo $news_add->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news_add->image->Visible) { // image ?>
	<div id="r_image" class="form-group row">
		<label id="elh_news_image" for="x_image" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news_add->image->caption() ?><?php echo $news_add->image->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div <?php echo $news_add->image->cellAttributes() ?>>
<span id="el_news_image">
<input type="text" data-table="news" data-field="x_image" name="x_image" id="x_image" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($news_add->image->getPlaceHolder()) ?>" value="<?php echo $news_add->image->EditValue ?>"<?php echo $news_add->image->editAttributes() ?>>
</span>
<?php echo $news_add->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($news_add->report->Visible) { // report ?>
	<div id="r_report" class="form-group row">
		<label id="elh_news_report" for="x_report" class="<?php echo $news_add->LeftColumnClass ?>"><?php echo $news_add->report->caption() ?><?php echo $news_add->report->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $news_add->RightColumnClass ?>"><div <?php echo $news_add->report->cellAttributes() ?>>
<span id="el_news_report">
<textarea data-table="news" data-field="x_report" name="x_report" id="x_report" cols="35" rows="4" placeholder="<?php echo HtmlEncode($news_add->report->getPlaceHolder()) ?>"<?php echo $news_add->report->editAttributes() ?>><?php echo $news_add->report->EditValue ?></textarea>
</span>
<?php echo $news_add->report->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$news_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $news_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $news_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$news_add->showPageFooter();
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
$news_add->terminate();
?>