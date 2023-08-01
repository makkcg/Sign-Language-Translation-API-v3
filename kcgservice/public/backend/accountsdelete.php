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
$accounts_delete = new accounts_delete();

// Run the page
$accounts_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$accounts_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var faccountsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	faccountsdelete = currentForm = new ew.Form("faccountsdelete", "delete");
	loadjs.done("faccountsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $accounts_delete->showPageHeader(); ?>
<?php
$accounts_delete->showMessage();
?>
<form name="faccountsdelete" id="faccountsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="accounts">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($accounts_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($accounts_delete->id->Visible) { // id ?>
		<th class="<?php echo $accounts_delete->id->headerCellClass() ?>"><span id="elh_accounts_id" class="accounts_id"><?php echo $accounts_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->user_id->Visible) { // user_id ?>
		<th class="<?php echo $accounts_delete->user_id->headerCellClass() ?>"><span id="elh_accounts_user_id" class="accounts_user_id"><?php echo $accounts_delete->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->name->Visible) { // name ?>
		<th class="<?php echo $accounts_delete->name->headerCellClass() ?>"><span id="elh_accounts_name" class="accounts_name"><?php echo $accounts_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->_email->Visible) { // email ?>
		<th class="<?php echo $accounts_delete->_email->headerCellClass() ?>"><span id="elh_accounts__email" class="accounts__email"><?php echo $accounts_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->phone->Visible) { // phone ?>
		<th class="<?php echo $accounts_delete->phone->headerCellClass() ?>"><span id="elh_accounts_phone" class="accounts_phone"><?php echo $accounts_delete->phone->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->words->Visible) { // words ?>
		<th class="<?php echo $accounts_delete->words->headerCellClass() ?>"><span id="elh_accounts_words" class="accounts_words"><?php echo $accounts_delete->words->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->used_words->Visible) { // used_words ?>
		<th class="<?php echo $accounts_delete->used_words->headerCellClass() ?>"><span id="elh_accounts_used_words" class="accounts_used_words"><?php echo $accounts_delete->used_words->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->remain_words->Visible) { // remain_words ?>
		<th class="<?php echo $accounts_delete->remain_words->headerCellClass() ?>"><span id="elh_accounts_remain_words" class="accounts_remain_words"><?php echo $accounts_delete->remain_words->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->connection_points->Visible) { // connection_points ?>
		<th class="<?php echo $accounts_delete->connection_points->headerCellClass() ?>"><span id="elh_accounts_connection_points" class="accounts_connection_points"><?php echo $accounts_delete->connection_points->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->package->Visible) { // package ?>
		<th class="<?php echo $accounts_delete->package->headerCellClass() ?>"><span id="elh_accounts_package" class="accounts_package"><?php echo $accounts_delete->package->caption() ?></span></th>
<?php } ?>
<?php if ($accounts_delete->expire_date->Visible) { // expire_date ?>
		<th class="<?php echo $accounts_delete->expire_date->headerCellClass() ?>"><span id="elh_accounts_expire_date" class="accounts_expire_date"><?php echo $accounts_delete->expire_date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$accounts_delete->RecordCount = 0;
$i = 0;
while (!$accounts_delete->Recordset->EOF) {
	$accounts_delete->RecordCount++;
	$accounts_delete->RowCount++;

	// Set row properties
	$accounts->resetAttributes();
	$accounts->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$accounts_delete->loadRowValues($accounts_delete->Recordset);

	// Render row
	$accounts_delete->renderRow();
?>
	<tr <?php echo $accounts->rowAttributes() ?>>
<?php if ($accounts_delete->id->Visible) { // id ?>
		<td <?php echo $accounts_delete->id->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_id" class="accounts_id">
<span<?php echo $accounts_delete->id->viewAttributes() ?>><?php echo $accounts_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->user_id->Visible) { // user_id ?>
		<td <?php echo $accounts_delete->user_id->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_user_id" class="accounts_user_id">
<span<?php echo $accounts_delete->user_id->viewAttributes() ?>><?php echo $accounts_delete->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->name->Visible) { // name ?>
		<td <?php echo $accounts_delete->name->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_name" class="accounts_name">
<span<?php echo $accounts_delete->name->viewAttributes() ?>><?php echo $accounts_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->_email->Visible) { // email ?>
		<td <?php echo $accounts_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts__email" class="accounts__email">
<span<?php echo $accounts_delete->_email->viewAttributes() ?>><?php echo $accounts_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->phone->Visible) { // phone ?>
		<td <?php echo $accounts_delete->phone->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_phone" class="accounts_phone">
<span<?php echo $accounts_delete->phone->viewAttributes() ?>><?php echo $accounts_delete->phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->words->Visible) { // words ?>
		<td <?php echo $accounts_delete->words->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_words" class="accounts_words">
<span<?php echo $accounts_delete->words->viewAttributes() ?>><?php echo $accounts_delete->words->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->used_words->Visible) { // used_words ?>
		<td <?php echo $accounts_delete->used_words->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_used_words" class="accounts_used_words">
<span<?php echo $accounts_delete->used_words->viewAttributes() ?>><?php echo $accounts_delete->used_words->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->remain_words->Visible) { // remain_words ?>
		<td <?php echo $accounts_delete->remain_words->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_remain_words" class="accounts_remain_words">
<span<?php echo $accounts_delete->remain_words->viewAttributes() ?>><?php echo $accounts_delete->remain_words->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->connection_points->Visible) { // connection_points ?>
		<td <?php echo $accounts_delete->connection_points->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_connection_points" class="accounts_connection_points">
<span<?php echo $accounts_delete->connection_points->viewAttributes() ?>><?php echo $accounts_delete->connection_points->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->package->Visible) { // package ?>
		<td <?php echo $accounts_delete->package->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_package" class="accounts_package">
<span<?php echo $accounts_delete->package->viewAttributes() ?>><?php echo $accounts_delete->package->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accounts_delete->expire_date->Visible) { // expire_date ?>
		<td <?php echo $accounts_delete->expire_date->cellAttributes() ?>>
<span id="el<?php echo $accounts_delete->RowCount ?>_accounts_expire_date" class="accounts_expire_date">
<span<?php echo $accounts_delete->expire_date->viewAttributes() ?>><?php echo $accounts_delete->expire_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$accounts_delete->Recordset->moveNext();
}
$accounts_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $accounts_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$accounts_delete->showPageFooter();
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
$accounts_delete->terminate();
?>