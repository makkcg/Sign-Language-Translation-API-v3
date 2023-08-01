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
$news_view = new news_view();

// Run the page
$news_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$news_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$news_view->isExport()) { ?>
<script>
var fnewsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fnewsview = currentForm = new ew.Form("fnewsview", "view");
	loadjs.done("fnewsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$news_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $news_view->ExportOptions->render("body") ?>
<?php $news_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $news_view->showPageHeader(); ?>
<?php
$news_view->showMessage();
?>
<form name="fnewsview" id="fnewsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="news">
<input type="hidden" name="modal" value="<?php echo (int)$news_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($news_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $news_view->TableLeftColumnClass ?>"><span id="elh_news_id"><?php echo $news_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $news_view->id->cellAttributes() ?>>
<span id="el_news_id">
<span<?php echo $news_view->id->viewAttributes() ?>><?php echo $news_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($news_view->title->Visible) { // title ?>
	<tr id="r_title">
		<td class="<?php echo $news_view->TableLeftColumnClass ?>"><span id="elh_news_title"><?php echo $news_view->title->caption() ?></span></td>
		<td data-name="title" <?php echo $news_view->title->cellAttributes() ?>>
<span id="el_news_title">
<span<?php echo $news_view->title->viewAttributes() ?>><?php echo $news_view->title->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($news_view->image->Visible) { // image ?>
	<tr id="r_image">
		<td class="<?php echo $news_view->TableLeftColumnClass ?>"><span id="elh_news_image"><?php echo $news_view->image->caption() ?></span></td>
		<td data-name="image" <?php echo $news_view->image->cellAttributes() ?>>
<span id="el_news_image">
<span<?php echo $news_view->image->viewAttributes() ?>><?php echo $news_view->image->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($news_view->report->Visible) { // report ?>
	<tr id="r_report">
		<td class="<?php echo $news_view->TableLeftColumnClass ?>"><span id="elh_news_report"><?php echo $news_view->report->caption() ?></span></td>
		<td data-name="report" <?php echo $news_view->report->cellAttributes() ?>>
<span id="el_news_report">
<span<?php echo $news_view->report->viewAttributes() ?>><?php echo $news_view->report->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$news_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$news_view->isExport()) { ?>
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
$news_view->terminate();
?>