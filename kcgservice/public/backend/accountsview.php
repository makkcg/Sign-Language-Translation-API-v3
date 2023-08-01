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
$accounts_view = new accounts_view();

// Run the page
$accounts_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$accounts_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$accounts_view->isExport()) { ?>
<script>
var faccountsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	faccountsview = currentForm = new ew.Form("faccountsview", "view");
	loadjs.done("faccountsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$accounts_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $accounts_view->ExportOptions->render("body") ?>
<?php $accounts_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $accounts_view->showPageHeader(); ?>
<?php
$accounts_view->showMessage();
?>
<form name="faccountsview" id="faccountsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="accounts">
<input type="hidden" name="modal" value="<?php echo (int)$accounts_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($accounts_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_id"><?php echo $accounts_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $accounts_view->id->cellAttributes() ?>>
<span id="el_accounts_id">
<span<?php echo $accounts_view->id->viewAttributes() ?>><?php echo $accounts_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_user_id"><?php echo $accounts_view->user_id->caption() ?></span></td>
		<td data-name="user_id" <?php echo $accounts_view->user_id->cellAttributes() ?>>
<span id="el_accounts_user_id">
<span<?php echo $accounts_view->user_id->viewAttributes() ?>><?php echo $accounts_view->user_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_name"><?php echo $accounts_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $accounts_view->name->cellAttributes() ?>>
<span id="el_accounts_name">
<span<?php echo $accounts_view->name->viewAttributes() ?>><?php echo $accounts_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts__email"><?php echo $accounts_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $accounts_view->_email->cellAttributes() ?>>
<span id="el_accounts__email">
<span<?php echo $accounts_view->_email->viewAttributes() ?>><?php echo $accounts_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->phone->Visible) { // phone ?>
	<tr id="r_phone">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_phone"><?php echo $accounts_view->phone->caption() ?></span></td>
		<td data-name="phone" <?php echo $accounts_view->phone->cellAttributes() ?>>
<span id="el_accounts_phone">
<span<?php echo $accounts_view->phone->viewAttributes() ?>><?php echo $accounts_view->phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->words->Visible) { // words ?>
	<tr id="r_words">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_words"><?php echo $accounts_view->words->caption() ?></span></td>
		<td data-name="words" <?php echo $accounts_view->words->cellAttributes() ?>>
<span id="el_accounts_words">
<span<?php echo $accounts_view->words->viewAttributes() ?>><?php echo $accounts_view->words->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->used_words->Visible) { // used_words ?>
	<tr id="r_used_words">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_used_words"><?php echo $accounts_view->used_words->caption() ?></span></td>
		<td data-name="used_words" <?php echo $accounts_view->used_words->cellAttributes() ?>>
<span id="el_accounts_used_words">
<span<?php echo $accounts_view->used_words->viewAttributes() ?>><?php echo $accounts_view->used_words->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->remain_words->Visible) { // remain_words ?>
	<tr id="r_remain_words">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_remain_words"><?php echo $accounts_view->remain_words->caption() ?></span></td>
		<td data-name="remain_words" <?php echo $accounts_view->remain_words->cellAttributes() ?>>
<span id="el_accounts_remain_words">
<span<?php echo $accounts_view->remain_words->viewAttributes() ?>><?php echo $accounts_view->remain_words->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->connection_points->Visible) { // connection_points ?>
	<tr id="r_connection_points">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_connection_points"><?php echo $accounts_view->connection_points->caption() ?></span></td>
		<td data-name="connection_points" <?php echo $accounts_view->connection_points->cellAttributes() ?>>
<span id="el_accounts_connection_points">
<span<?php echo $accounts_view->connection_points->viewAttributes() ?>><?php echo $accounts_view->connection_points->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->package->Visible) { // package ?>
	<tr id="r_package">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_package"><?php echo $accounts_view->package->caption() ?></span></td>
		<td data-name="package" <?php echo $accounts_view->package->cellAttributes() ?>>
<span id="el_accounts_package">
<span<?php echo $accounts_view->package->viewAttributes() ?>><?php echo $accounts_view->package->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($accounts_view->expire_date->Visible) { // expire_date ?>
	<tr id="r_expire_date">
		<td class="<?php echo $accounts_view->TableLeftColumnClass ?>"><span id="elh_accounts_expire_date"><?php echo $accounts_view->expire_date->caption() ?></span></td>
		<td data-name="expire_date" <?php echo $accounts_view->expire_date->cellAttributes() ?>>
<span id="el_accounts_expire_date">
<span<?php echo $accounts_view->expire_date->viewAttributes() ?>><?php echo $accounts_view->expire_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$accounts_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$accounts_view->isExport()) { ?>
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
$accounts_view->terminate();
?>