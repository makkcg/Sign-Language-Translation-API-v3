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
$customers_delete = new customers_delete();

// Run the page
$customers_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcustomersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcustomersdelete = currentForm = new ew.Form("fcustomersdelete", "delete");
	loadjs.done("fcustomersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $customers_delete->showPageHeader(); ?>
<?php
$customers_delete->showMessage();
?>
<form name="fcustomersdelete" id="fcustomersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($customers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($customers_delete->id->Visible) { // id ?>
		<th class="<?php echo $customers_delete->id->headerCellClass() ?>"><span id="elh_customers_id" class="customers_id"><?php echo $customers_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_id->Visible) { // customer_id ?>
		<th class="<?php echo $customers_delete->customer_id->headerCellClass() ?>"><span id="elh_customers_customer_id" class="customers_customer_id"><?php echo $customers_delete->customer_id->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->customer_name->Visible) { // customer_name ?>
		<th class="<?php echo $customers_delete->customer_name->headerCellClass() ?>"><span id="elh_customers_customer_name" class="customers_customer_name"><?php echo $customers_delete->customer_name->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->current_package->Visible) { // current_package ?>
		<th class="<?php echo $customers_delete->current_package->headerCellClass() ?>"><span id="elh_customers_current_package" class="customers_current_package"><?php echo $customers_delete->current_package->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->remaine_words->Visible) { // remaine_words ?>
		<th class="<?php echo $customers_delete->remaine_words->headerCellClass() ?>"><span id="elh_customers_remaine_words" class="customers_remaine_words"><?php echo $customers_delete->remaine_words->caption() ?></span></th>
<?php } ?>
<?php if ($customers_delete->expiration->Visible) { // expiration ?>
		<th class="<?php echo $customers_delete->expiration->headerCellClass() ?>"><span id="elh_customers_expiration" class="customers_expiration"><?php echo $customers_delete->expiration->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$customers_delete->RecordCount = 0;
$i = 0;
while (!$customers_delete->Recordset->EOF) {
	$customers_delete->RecordCount++;
	$customers_delete->RowCount++;

	// Set row properties
	$customers->resetAttributes();
	$customers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$customers_delete->loadRowValues($customers_delete->Recordset);

	// Render row
	$customers_delete->renderRow();
?>
	<tr <?php echo $customers->rowAttributes() ?>>
<?php if ($customers_delete->id->Visible) { // id ?>
		<td <?php echo $customers_delete->id->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_id" class="customers_id">
<span<?php echo $customers_delete->id->viewAttributes() ?>><?php echo $customers_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_id->Visible) { // customer_id ?>
		<td <?php echo $customers_delete->customer_id->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_id" class="customers_customer_id">
<span<?php echo $customers_delete->customer_id->viewAttributes() ?>><?php echo $customers_delete->customer_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->customer_name->Visible) { // customer_name ?>
		<td <?php echo $customers_delete->customer_name->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_customer_name" class="customers_customer_name">
<span<?php echo $customers_delete->customer_name->viewAttributes() ?>><?php echo $customers_delete->customer_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->current_package->Visible) { // current_package ?>
		<td <?php echo $customers_delete->current_package->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_current_package" class="customers_current_package">
<span<?php echo $customers_delete->current_package->viewAttributes() ?>><?php echo $customers_delete->current_package->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->remaine_words->Visible) { // remaine_words ?>
		<td <?php echo $customers_delete->remaine_words->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_remaine_words" class="customers_remaine_words">
<span<?php echo $customers_delete->remaine_words->viewAttributes() ?>><?php echo $customers_delete->remaine_words->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($customers_delete->expiration->Visible) { // expiration ?>
		<td <?php echo $customers_delete->expiration->cellAttributes() ?>>
<span id="el<?php echo $customers_delete->RowCount ?>_customers_expiration" class="customers_expiration">
<span<?php echo $customers_delete->expiration->viewAttributes() ?>><?php echo $customers_delete->expiration->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$customers_delete->Recordset->moveNext();
}
$customers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $customers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$customers_delete->showPageFooter();
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
$customers_delete->terminate();
?>