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
$customers_view = new customers_view();

// Run the page
$customers_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$customers_view->isExport()) { ?>
<script>
var fcustomersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcustomersview = currentForm = new ew.Form("fcustomersview", "view");
	loadjs.done("fcustomersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$customers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $customers_view->ExportOptions->render("body") ?>
<?php $customers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $customers_view->showPageHeader(); ?>
<?php
$customers_view->showMessage();
?>
<form name="fcustomersview" id="fcustomersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<input type="hidden" name="modal" value="<?php echo (int)$customers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($customers_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_id"><?php echo $customers_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $customers_view->id->cellAttributes() ?>>
<span id="el_customers_id">
<span<?php echo $customers_view->id->viewAttributes() ?>><?php echo $customers_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_id->Visible) { // customer_id ?>
	<tr id="r_customer_id">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_id"><?php echo $customers_view->customer_id->caption() ?></span></td>
		<td data-name="customer_id" <?php echo $customers_view->customer_id->cellAttributes() ?>>
<span id="el_customers_customer_id">
<span<?php echo $customers_view->customer_id->viewAttributes() ?>><?php echo $customers_view->customer_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->customer_name->Visible) { // customer_name ?>
	<tr id="r_customer_name">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_customer_name"><?php echo $customers_view->customer_name->caption() ?></span></td>
		<td data-name="customer_name" <?php echo $customers_view->customer_name->cellAttributes() ?>>
<span id="el_customers_customer_name">
<span<?php echo $customers_view->customer_name->viewAttributes() ?>><?php echo $customers_view->customer_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->current_package->Visible) { // current_package ?>
	<tr id="r_current_package">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_current_package"><?php echo $customers_view->current_package->caption() ?></span></td>
		<td data-name="current_package" <?php echo $customers_view->current_package->cellAttributes() ?>>
<span id="el_customers_current_package">
<span<?php echo $customers_view->current_package->viewAttributes() ?>><?php echo $customers_view->current_package->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->remaine_words->Visible) { // remaine_words ?>
	<tr id="r_remaine_words">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_remaine_words"><?php echo $customers_view->remaine_words->caption() ?></span></td>
		<td data-name="remaine_words" <?php echo $customers_view->remaine_words->cellAttributes() ?>>
<span id="el_customers_remaine_words">
<span<?php echo $customers_view->remaine_words->viewAttributes() ?>><?php echo $customers_view->remaine_words->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($customers_view->expiration->Visible) { // expiration ?>
	<tr id="r_expiration">
		<td class="<?php echo $customers_view->TableLeftColumnClass ?>"><span id="elh_customers_expiration"><?php echo $customers_view->expiration->caption() ?></span></td>
		<td data-name="expiration" <?php echo $customers_view->expiration->cellAttributes() ?>>
<span id="el_customers_expiration">
<span<?php echo $customers_view->expiration->viewAttributes() ?>><?php echo $customers_view->expiration->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$customers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$customers_view->isExport()) { ?>
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
$customers_view->terminate();
?>