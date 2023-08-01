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
$users_edit = new users_edit();

// Run the page
$users_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fusersedit = currentForm = new ew.Form("fusersedit", "edit");

	// Validate form
	fusersedit.validate = function() {
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
			<?php if ($users_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->id->caption(), $users_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->name->caption(), $users_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->_email->caption(), $users_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->phone->Required) { ?>
				elm = this.getElements("x" + infix + "_phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->phone->caption(), $users_edit->phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->pwd->Required) { ?>
				elm = this.getElements("x" + infix + "_pwd");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->pwd->caption(), $users_edit->pwd->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->package->Required) { ?>
				elm = this.getElements("x" + infix + "_package");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->package->caption(), $users_edit->package->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->role->Required) { ?>
				elm = this.getElements("x" + infix + "_role");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->role->caption(), $users_edit->role->RequiredErrorMessage)) ?>");
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
	fusersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusersedit.lists["x_package"] = <?php echo $users_edit->package->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_package"].options = <?php echo JsonEncode($users_edit->package->lookupOptions()) ?>;
	fusersedit.lists["x_role"] = <?php echo $users_edit->role->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_role"].options = <?php echo JsonEncode($users_edit->role->options(FALSE, TRUE)) ?>;
	loadjs.done("fusersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_edit->showPageHeader(); ?>
<?php
$users_edit->showMessage();
?>
<form name="fusersedit" id="fusersedit" class="<?php echo $users_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$users_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($users_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_users_id" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->id->caption() ?><?php echo $users_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?php echo $users_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($users_edit->id->CurrentValue) ?>">
<?php echo $users_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_users_name" for="x_name" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->name->caption() ?><?php echo $users_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->name->cellAttributes() ?>>
<span id="el_users_name">
<input type="text" data-table="users" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($users_edit->name->getPlaceHolder()) ?>" value="<?php echo $users_edit->name->EditValue ?>"<?php echo $users_edit->name->editAttributes() ?>>
</span>
<?php echo $users_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_users__email" for="x__email" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->_email->caption() ?><?php echo $users_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->_email->cellAttributes() ?>>
<span id="el_users__email">
<input type="text" data-table="users" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($users_edit->_email->getPlaceHolder()) ?>" value="<?php echo $users_edit->_email->EditValue ?>"<?php echo $users_edit->_email->editAttributes() ?>>
</span>
<?php echo $users_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group row">
		<label id="elh_users_phone" for="x_phone" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->phone->caption() ?><?php echo $users_edit->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->phone->cellAttributes() ?>>
<span id="el_users_phone">
<input type="text" data-table="users" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($users_edit->phone->getPlaceHolder()) ?>" value="<?php echo $users_edit->phone->EditValue ?>"<?php echo $users_edit->phone->editAttributes() ?>>
</span>
<?php echo $users_edit->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->pwd->Visible) { // pwd ?>
	<div id="r_pwd" class="form-group row">
		<label id="elh_users_pwd" for="x_pwd" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->pwd->caption() ?><?php echo $users_edit->pwd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->pwd->cellAttributes() ?>>
<span id="el_users_pwd">
<input type="text" data-table="users" data-field="x_pwd" name="x_pwd" id="x_pwd" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($users_edit->pwd->getPlaceHolder()) ?>" value="<?php echo $users_edit->pwd->EditValue ?>"<?php echo $users_edit->pwd->editAttributes() ?>>
</span>
<?php echo $users_edit->pwd->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->package->Visible) { // package ?>
	<div id="r_package" class="form-group row">
		<label id="elh_users_package" for="x_package" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->package->caption() ?><?php echo $users_edit->package->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->package->cellAttributes() ?>>
<span id="el_users_package">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($users_edit->package->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $users_edit->package->ViewValue ?></button>
		<div id="dsl_x_package" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $users_edit->package->radioButtonListHtml(TRUE, "x_package") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_package" class="ew-template"><input type="radio" class="custom-control-input" data-table="users" data-field="x_package" data-value-separator="<?php echo $users_edit->package->displayValueSeparatorAttribute() ?>" name="x_package" id="x_package" value="{value}"<?php echo $users_edit->package->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$users_edit->package->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $users_edit->package->Lookup->getParamTag($users_edit, "p_x_package") ?>
</span>
<?php echo $users_edit->package->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->role->Visible) { // role ?>
	<div id="r_role" class="form-group row">
		<label id="elh_users_role" for="x_role" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->role->caption() ?><?php echo $users_edit->role->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->role->cellAttributes() ?>>
<span id="el_users_role">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($users_edit->role->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $users_edit->role->ViewValue ?></button>
		<div id="dsl_x_role" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $users_edit->role->radioButtonListHtml(TRUE, "x_role") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_role" class="ew-template"><input type="radio" class="custom-control-input" data-table="users" data-field="x_role" data-value-separator="<?php echo $users_edit->role->displayValueSeparatorAttribute() ?>" name="x_role" id="x_role" value="{value}"<?php echo $users_edit->role->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$users_edit->role->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
<?php echo $users_edit->role->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_edit->showPageFooter();
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
$users_edit->terminate();
?>