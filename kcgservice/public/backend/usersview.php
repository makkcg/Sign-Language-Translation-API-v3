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
$users_view = new users_view();

// Run the page
$users_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$users_view->isExport()) { ?>
<script>
var fusersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fusersview = currentForm = new ew.Form("fusersview", "view");
	loadjs.done("fusersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$users_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $users_view->ExportOptions->render("body") ?>
<?php $users_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $users_view->showPageHeader(); ?>
<?php
$users_view->showMessage();
?>
<form name="fusersview" id="fusersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?php echo (int)$users_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($users_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_id"><?php echo $users_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $users_view->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?php echo $users_view->id->viewAttributes() ?>><?php echo $users_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_name"><?php echo $users_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $users_view->name->cellAttributes() ?>>
<span id="el_users_name">
<span<?php echo $users_view->name->viewAttributes() ?>><?php echo $users_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users__email"><?php echo $users_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $users_view->_email->cellAttributes() ?>>
<span id="el_users__email">
<span<?php echo $users_view->_email->viewAttributes() ?>><?php echo $users_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->phone->Visible) { // phone ?>
	<tr id="r_phone">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_phone"><?php echo $users_view->phone->caption() ?></span></td>
		<td data-name="phone" <?php echo $users_view->phone->cellAttributes() ?>>
<span id="el_users_phone">
<span<?php echo $users_view->phone->viewAttributes() ?>><?php echo $users_view->phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->pwd->Visible) { // pwd ?>
	<tr id="r_pwd">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_pwd"><?php echo $users_view->pwd->caption() ?></span></td>
		<td data-name="pwd" <?php echo $users_view->pwd->cellAttributes() ?>>
<span id="el_users_pwd">
<span<?php echo $users_view->pwd->viewAttributes() ?>><?php echo $users_view->pwd->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->package->Visible) { // package ?>
	<tr id="r_package">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_package"><?php echo $users_view->package->caption() ?></span></td>
		<td data-name="package" <?php echo $users_view->package->cellAttributes() ?>>
<span id="el_users_package">
<span<?php echo $users_view->package->viewAttributes() ?>><?php echo $users_view->package->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->role->Visible) { // role ?>
	<tr id="r_role">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_role"><?php echo $users_view->role->caption() ?></span></td>
		<td data-name="role" <?php echo $users_view->role->cellAttributes() ?>>
<span id="el_users_role">
<span<?php echo $users_view->role->viewAttributes() ?>><?php echo $users_view->role->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$users_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$users_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$users_view->terminate();
?>