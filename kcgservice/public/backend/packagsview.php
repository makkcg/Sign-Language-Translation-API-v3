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
$packags_view = new packags_view();

// Run the page
$packags_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$packags_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$packags_view->isExport()) { ?>
<script>
var fpackagsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpackagsview = currentForm = new ew.Form("fpackagsview", "view");
	loadjs.done("fpackagsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$packags_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $packags_view->ExportOptions->render("body") ?>
<?php $packags_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $packags_view->showPageHeader(); ?>
<?php
$packags_view->showMessage();
?>
<form name="fpackagsview" id="fpackagsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="packags">
<input type="hidden" name="modal" value="<?php echo (int)$packags_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($packags_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $packags_view->TableLeftColumnClass ?>"><span id="elh_packags_id"><?php echo $packags_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $packags_view->id->cellAttributes() ?>>
<span id="el_packags_id">
<span<?php echo $packags_view->id->viewAttributes() ?>><?php echo $packags_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packags_view->package->Visible) { // package ?>
	<tr id="r_package">
		<td class="<?php echo $packags_view->TableLeftColumnClass ?>"><span id="elh_packags_package"><?php echo $packags_view->package->caption() ?></span></td>
		<td data-name="package" <?php echo $packags_view->package->cellAttributes() ?>>
<span id="el_packags_package">
<span<?php echo $packags_view->package->viewAttributes() ?>><?php echo $packags_view->package->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packags_view->number_of_words->Visible) { // number_of_words ?>
	<tr id="r_number_of_words">
		<td class="<?php echo $packags_view->TableLeftColumnClass ?>"><span id="elh_packags_number_of_words"><?php echo $packags_view->number_of_words->caption() ?></span></td>
		<td data-name="number_of_words" <?php echo $packags_view->number_of_words->cellAttributes() ?>>
<span id="el_packags_number_of_words">
<span<?php echo $packags_view->number_of_words->viewAttributes() ?>><?php echo $packags_view->number_of_words->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packags_view->period_in_months->Visible) { // period_in_months ?>
	<tr id="r_period_in_months">
		<td class="<?php echo $packags_view->TableLeftColumnClass ?>"><span id="elh_packags_period_in_months"><?php echo $packags_view->period_in_months->caption() ?></span></td>
		<td data-name="period_in_months" <?php echo $packags_view->period_in_months->cellAttributes() ?>>
<span id="el_packags_period_in_months">
<span<?php echo $packags_view->period_in_months->viewAttributes() ?>><?php echo $packags_view->period_in_months->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packags_view->connection_points->Visible) { // connection_points ?>
	<tr id="r_connection_points">
		<td class="<?php echo $packags_view->TableLeftColumnClass ?>"><span id="elh_packags_connection_points"><?php echo $packags_view->connection_points->caption() ?></span></td>
		<td data-name="connection_points" <?php echo $packags_view->connection_points->cellAttributes() ?>>
<span id="el_packags_connection_points">
<span<?php echo $packags_view->connection_points->viewAttributes() ?>><?php echo $packags_view->connection_points->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packags_view->price->Visible) { // price ?>
	<tr id="r_price">
		<td class="<?php echo $packags_view->TableLeftColumnClass ?>"><span id="elh_packags_price"><?php echo $packags_view->price->caption() ?></span></td>
		<td data-name="price" <?php echo $packags_view->price->cellAttributes() ?>>
<span id="el_packags_price">
<span<?php echo $packags_view->price->viewAttributes() ?>><?php echo $packags_view->price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packags_view->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $packags_view->TableLeftColumnClass ?>"><span id="elh_packags_created_at"><?php echo $packags_view->created_at->caption() ?></span></td>
		<td data-name="created_at" <?php echo $packags_view->created_at->cellAttributes() ?>>
<span id="el_packags_created_at">
<span<?php echo $packags_view->created_at->viewAttributes() ?>><?php echo $packags_view->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($packags_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $packags_view->TableLeftColumnClass ?>"><span id="elh_packags_updated_at"><?php echo $packags_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $packags_view->updated_at->cellAttributes() ?>>
<span id="el_packags_updated_at">
<span<?php echo $packags_view->updated_at->viewAttributes() ?>><?php echo $packags_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$packags_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$packags_view->isExport()) { ?>
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
$packags_view->terminate();
?>