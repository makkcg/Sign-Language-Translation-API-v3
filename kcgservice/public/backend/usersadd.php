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
$users_add = new users_add();

// Run the page
$users_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fusersadd = currentForm = new ew.Form("fusersadd", "add");

	// Validate form
	fusersadd.validate = function() {
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
			<?php if ($users_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->name->caption(), $users_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->_email->caption(), $users_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->phone->Required) { ?>
				elm = this.getElements("x" + infix + "_phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->phone->caption(), $users_add->phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->pwd->Required) { ?>
				elm = this.getElements("x" + infix + "_pwd");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->pwd->caption(), $users_add->pwd->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->package->Required) { ?>
				elm = this.getElements("x" + infix + "_package");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->package->caption(), $users_add->package->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->role->Required) { ?>
				elm = this.getElements("x" + infix + "_role");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->role->caption(), $users_add->role->RequiredErrorMessage)) ?>");
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
	fusersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusersadd.lists["x_package"] = <?php echo $users_add->package->Lookup->toClientList($users_add) ?>;
	fusersadd.lists["x_package"].options = <?php echo JsonEncode($users_add->package->lookupOptions()) ?>;
	fusersadd.lists["x_role"] = <?php echo $users_add->role->Lookup->toClientList($users_add) ?>;
	fusersadd.lists["x_role"].options = <?php echo JsonEncode($users_add->role->options(FALSE, TRUE)) ?>;
	loadjs.done("fusersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_add->showPageHeader(); ?>
<?php
$users_add->showMessage();
?>
<form name="fusersadd" id="fusersadd" class="<?php echo $users_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$users_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($users_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_users_name" for="x_name" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->name->caption() ?><?php echo $users_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->name->cellAttributes() ?>>
<span id="el_users_name">
<input type="text" data-table="users" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($users_add->name->getPlaceHolder()) ?>" value="<?php echo $users_add->name->EditValue ?>"<?php echo $users_add->name->editAttributes() ?>>
</span>
<?php echo $users_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_users__email" for="x__email" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->_email->caption() ?><?php echo $users_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->_email->cellAttributes() ?>>
<span id="el_users__email">
<input type="text" data-table="users" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($users_add->_email->getPlaceHolder()) ?>" value="<?php echo $users_add->_email->EditValue ?>"<?php echo $users_add->_email->editAttributes() ?>>
</span>
<?php echo $users_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group row">
		<label id="elh_users_phone" for="x_phone" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->phone->caption() ?><?php echo $users_add->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->phone->cellAttributes() ?>>
<span id="el_users_phone">
<input type="text" data-table="users" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($users_add->phone->getPlaceHolder()) ?>" value="<?php echo $users_add->phone->EditValue ?>"<?php echo $users_add->phone->editAttributes() ?>>
</span>
<?php echo $users_add->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->pwd->Visible) { // pwd ?>
	<div id="r_pwd" class="form-group row">
		<label id="elh_users_pwd" for="x_pwd" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->pwd->caption() ?><?php echo $users_add->pwd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->pwd->cellAttributes() ?>>
<span id="el_users_pwd">
<input type="text" data-table="users" data-field="x_pwd" name="x_pwd" id="x_pwd" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($users_add->pwd->getPlaceHolder()) ?>" value="<?php echo $users_add->pwd->EditValue ?>"<?php echo $users_add->pwd->editAttributes() ?>>
</span>
<?php echo $users_add->pwd->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->package->Visible) { // package ?>
	<div id="r_package" class="form-group row">
		<label id="elh_users_package" for="x_package" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->package->caption() ?><?php echo $users_add->package->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->package->cellAttributes() ?>>
<span id="el_users_package">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($users_add->package->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $users_add->package->ViewValue ?></button>
		<div id="dsl_x_package" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $users_add->package->radioButtonListHtml(TRUE, "x_package") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_package" class="ew-template"><input type="radio" class="custom-control-input" data-table="users" data-field="x_package" data-value-separator="<?php echo $users_add->package->displayValueSeparatorAttribute() ?>" name="x_package" id="x_package" value="{value}"<?php echo $users_add->package->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$users_add->package->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $users_add->package->Lookup->getParamTag($users_add, "p_x_package") ?>
</span>
<?php echo $users_add->package->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->role->Visible) { // role ?>
	<div id="r_role" class="form-group row">
		<label id="elh_users_role" for="x_role" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->role->caption() ?><?php echo $users_add->role->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->role->cellAttributes() ?>>
<span id="el_users_role">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($users_add->role->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $users_add->role->ViewValue ?></button>
		<div id="dsl_x_role" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $users_add->role->radioButtonListHtml(TRUE, "x_role") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_role" class="ew-template"><input type="radio" class="custom-control-input" data-table="users" data-field="x_role" data-value-separator="<?php echo $users_add->role->displayValueSeparatorAttribute() ?>" name="x_role" id="x_role" value="{value}"<?php echo $users_add->role->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$users_add->role->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
<?php echo $users_add->role->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_add->showPageFooter();
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
$users_add->terminate();
?>