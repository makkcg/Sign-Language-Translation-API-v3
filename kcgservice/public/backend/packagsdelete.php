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
$packags_delete = new packags_delete();

// Run the page
$packags_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$packags_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpackagsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpackagsdelete = currentForm = new ew.Form("fpackagsdelete", "delete");
	loadjs.done("fpackagsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $packags_delete->showPageHeader(); ?>
<?php
$packags_delete->showMessage();
?>
<form name="fpackagsdelete" id="fpackagsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="packags">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($packags_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($packags_delete->id->Visible) { // id ?>
		<th class="<?php echo $packags_delete->id->headerCellClass() ?>"><span id="elh_packags_id" class="packags_id"><?php echo $packags_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($packags_delete->package->Visible) { // package ?>
		<th class="<?php echo $packags_delete->package->headerCellClass() ?>"><span id="elh_packags_package" class="packags_package"><?php echo $packags_delete->package->caption() ?></span></th>
<?php } ?>
<?php if ($packags_delete->number_of_words->Visible) { // number_of_words ?>
		<th class="<?php echo $packags_delete->number_of_words->headerCellClass() ?>"><span id="elh_packags_number_of_words" class="packags_number_of_words"><?php echo $packags_delete->number_of_words->caption() ?></span></th>
<?php } ?>
<?php if ($packags_delete->period_in_months->Visible) { // period_in_months ?>
		<th class="<?php echo $packags_delete->period_in_months->headerCellClass() ?>"><span id="elh_packags_period_in_months" class="packags_period_in_months"><?php echo $packags_delete->period_in_months->caption() ?></span></th>
<?php } ?>
<?php if ($packags_delete->connection_points->Visible) { // connection_points ?>
		<th class="<?php echo $packags_delete->connection_points->headerCellClass() ?>"><span id="elh_packags_connection_points" class="packags_connection_points"><?php echo $packags_delete->connection_points->caption() ?></span></th>
<?php } ?>
<?php if ($packags_delete->price->Visible) { // price ?>
		<th class="<?php echo $packags_delete->price->headerCellClass() ?>"><span id="elh_packags_price" class="packags_price"><?php echo $packags_delete->price->caption() ?></span></th>
<?php } ?>
<?php if ($packags_delete->created_at->Visible) { // created_at ?>
		<th class="<?php echo $packags_delete->created_at->headerCellClass() ?>"><span id="elh_packags_created_at" class="packags_created_at"><?php echo $packags_delete->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($packags_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $packags_delete->updated_at->headerCellClass() ?>"><span id="elh_packags_updated_at" class="packags_updated_at"><?php echo $packags_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$packags_delete->RecordCount = 0;
$i = 0;
while (!$packags_delete->Recordset->EOF) {
	$packags_delete->RecordCount++;
	$packags_delete->RowCount++;

	// Set row properties
	$packags->resetAttributes();
	$packags->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$packags_delete->loadRowValues($packags_delete->Recordset);

	// Render row
	$packags_delete->renderRow();
?>
	<tr <?php echo $packags->rowAttributes() ?>>
<?php if ($packags_delete->id->Visible) { // id ?>
		<td <?php echo $packags_delete->id->cellAttributes() ?>>
<span id="el<?php echo $packags_delete->RowCount ?>_packags_id" class="packags_id">
<span<?php echo $packags_delete->id->viewAttributes() ?>><?php echo $packags_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($packags_delete->package->Visible) { // package ?>
		<td <?php echo $packags_delete->package->cellAttributes() ?>>
<span id="el<?php echo $packags_delete->RowCount ?>_packags_package" class="packags_package">
<span<?php echo $packags_delete->package->viewAttributes() ?>><?php echo $packags_delete->package->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($packags_delete->number_of_words->Visible) { // number_of_words ?>
		<td <?php echo $packags_delete->number_of_words->cellAttributes() ?>>
<span id="el<?php echo $packags_delete->RowCount ?>_packags_number_of_words" class="packags_number_of_words">
<span<?php echo $packags_delete->number_of_words->viewAttributes() ?>><?php echo $packags_delete->number_of_words->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($packags_delete->period_in_months->Visible) { // period_in_months ?>
		<td <?php echo $packags_delete->period_in_months->cellAttributes() ?>>
<span id="el<?php echo $packags_delete->RowCount ?>_packags_period_in_months" class="packags_period_in_months">
<span<?php echo $packags_delete->period_in_months->viewAttributes() ?>><?php echo $packags_delete->period_in_months->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($packags_delete->connection_points->Visible) { // connection_points ?>
		<td <?php echo $packags_delete->connection_points->cellAttributes() ?>>
<span id="el<?php echo $packags_delete->RowCount ?>_packags_connection_points" class="packags_connection_points">
<span<?php echo $packags_delete->connection_points->viewAttributes() ?>><?php echo $packags_delete->connection_points->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($packags_delete->price->Visible) { // price ?>
		<td <?php echo $packags_delete->price->cellAttributes() ?>>
<span id="el<?php echo $packags_delete->RowCount ?>_packags_price" class="packags_price">
<span<?php echo $packags_delete->price->viewAttributes() ?>><?php echo $packags_delete->price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($packags_delete->created_at->Visible) { // created_at ?>
		<td <?php echo $packags_delete->created_at->cellAttributes() ?>>
<span id="el<?php echo $packags_delete->RowCount ?>_packags_created_at" class="packags_created_at">
<span<?php echo $packags_delete->created_at->viewAttributes() ?>><?php echo $packags_delete->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($packags_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $packags_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $packags_delete->RowCount ?>_packags_updated_at" class="packags_updated_at">
<span<?php echo $packags_delete->updated_at->viewAttributes() ?>><?php echo $packags_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$packags_delete->Recordset->moveNext();
}
$packags_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $packags_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$packags_delete->showPageFooter();
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
$packags_delete->terminate();
?>