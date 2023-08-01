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
$users_delete = new users_delete();

// Run the page
$users_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fusersdelete = currentForm = new ew.Form("fusersdelete", "delete");
	loadjs.done("fusersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_delete->showPageHeader(); ?>
<?php
$users_delete->showMessage();
?>
<form name="fusersdelete" id="fusersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($users_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($users_delete->id->Visible) { // id ?>
		<th class="<?php echo $users_delete->id->headerCellClass() ?>"><span id="elh_users_id" class="users_id"><?php echo $users_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->name->Visible) { // name ?>
		<th class="<?php echo $users_delete->name->headerCellClass() ?>"><span id="elh_users_name" class="users_name"><?php echo $users_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->_email->Visible) { // email ?>
		<th class="<?php echo $users_delete->_email->headerCellClass() ?>"><span id="elh_users__email" class="users__email"><?php echo $users_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->phone->Visible) { // phone ?>
		<th class="<?php echo $users_delete->phone->headerCellClass() ?>"><span id="elh_users_phone" class="users_phone"><?php echo $users_delete->phone->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->pwd->Visible) { // pwd ?>
		<th class="<?php echo $users_delete->pwd->headerCellClass() ?>"><span id="elh_users_pwd" class="users_pwd"><?php echo $users_delete->pwd->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->package->Visible) { // package ?>
		<th class="<?php echo $users_delete->package->headerCellClass() ?>"><span id="elh_users_package" class="users_package"><?php echo $users_delete->package->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->role->Visible) { // role ?>
		<th class="<?php echo $users_delete->role->headerCellClass() ?>"><span id="elh_users_role" class="users_role"><?php echo $users_delete->role->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$users_delete->RecordCount = 0;
$i = 0;
while (!$users_delete->Recordset->EOF) {
	$users_delete->RecordCount++;
	$users_delete->RowCount++;

	// Set row properties
	$users->resetAttributes();
	$users->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$users_delete->loadRowValues($users_delete->Recordset);

	// Render row
	$users_delete->renderRow();
?>
	<tr <?php echo $users->rowAttributes() ?>>
<?php if ($users_delete->id->Visible) { // id ?>
		<td <?php echo $users_delete->id->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_id" class="users_id">
<span<?php echo $users_delete->id->viewAttributes() ?>><?php echo $users_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->name->Visible) { // name ?>
		<td <?php echo $users_delete->name->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_name" class="users_name">
<span<?php echo $users_delete->name->viewAttributes() ?>><?php echo $users_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->_email->Visible) { // email ?>
		<td <?php echo $users_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users__email" class="users__email">
<span<?php echo $users_delete->_email->viewAttributes() ?>><?php echo $users_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->phone->Visible) { // phone ?>
		<td <?php echo $users_delete->phone->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_phone" class="users_phone">
<span<?php echo $users_delete->phone->viewAttributes() ?>><?php echo $users_delete->phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->pwd->Visible) { // pwd ?>
		<td <?php echo $users_delete->pwd->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_pwd" class="users_pwd">
<span<?php echo $users_delete->pwd->viewAttributes() ?>><?php echo $users_delete->pwd->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->package->Visible) { // package ?>
		<td <?php echo $users_delete->package->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_package" class="users_package">
<span<?php echo $users_delete->package->viewAttributes() ?>><?php echo $users_delete->package->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->role->Visible) { // role ?>
		<td <?php echo $users_delete->role->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_role" class="users_role">
<span<?php echo $users_delete->role->viewAttributes() ?>><?php echo $users_delete->role->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$users_delete->Recordset->moveNext();
}
$users_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$users_delete->showPageFooter();
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
$users_delete->terminate();
?>