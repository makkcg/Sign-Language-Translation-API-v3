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
$news_delete = new news_delete();

// Run the page
$news_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$news_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fnewsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fnewsdelete = currentForm = new ew.Form("fnewsdelete", "delete");
	loadjs.done("fnewsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $news_delete->showPageHeader(); ?>
<?php
$news_delete->showMessage();
?>
<form name="fnewsdelete" id="fnewsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="news">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($news_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($news_delete->id->Visible) { // id ?>
		<th class="<?php echo $news_delete->id->headerCellClass() ?>"><span id="elh_news_id" class="news_id"><?php echo $news_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($news_delete->title->Visible) { // title ?>
		<th class="<?php echo $news_delete->title->headerCellClass() ?>"><span id="elh_news_title" class="news_title"><?php echo $news_delete->title->caption() ?></span></th>
<?php } ?>
<?php if ($news_delete->image->Visible) { // image ?>
		<th class="<?php echo $news_delete->image->headerCellClass() ?>"><span id="elh_news_image" class="news_image"><?php echo $news_delete->image->caption() ?></span></th>
<?php } ?>
<?php if ($news_delete->report->Visible) { // report ?>
		<th class="<?php echo $news_delete->report->headerCellClass() ?>"><span id="elh_news_report" class="news_report"><?php echo $news_delete->report->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$news_delete->RecordCount = 0;
$i = 0;
while (!$news_delete->Recordset->EOF) {
	$news_delete->RecordCount++;
	$news_delete->RowCount++;

	// Set row properties
	$news->resetAttributes();
	$news->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$news_delete->loadRowValues($news_delete->Recordset);

	// Render row
	$news_delete->renderRow();
?>
	<tr <?php echo $news->rowAttributes() ?>>
<?php if ($news_delete->id->Visible) { // id ?>
		<td <?php echo $news_delete->id->cellAttributes() ?>>
<span id="el<?php echo $news_delete->RowCount ?>_news_id" class="news_id">
<span<?php echo $news_delete->id->viewAttributes() ?>><?php echo $news_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($news_delete->title->Visible) { // title ?>
		<td <?php echo $news_delete->title->cellAttributes() ?>>
<span id="el<?php echo $news_delete->RowCount ?>_news_title" class="news_title">
<span<?php echo $news_delete->title->viewAttributes() ?>><?php echo $news_delete->title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($news_delete->image->Visible) { // image ?>
		<td <?php echo $news_delete->image->cellAttributes() ?>>
<span id="el<?php echo $news_delete->RowCount ?>_news_image" class="news_image">
<span<?php echo $news_delete->image->viewAttributes() ?>><?php echo $news_delete->image->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($news_delete->report->Visible) { // report ?>
		<td <?php echo $news_delete->report->cellAttributes() ?>>
<span id="el<?php echo $news_delete->RowCount ?>_news_report" class="news_report">
<span<?php echo $news_delete->report->viewAttributes() ?>><?php echo $news_delete->report->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$news_delete->Recordset->moveNext();
}
$news_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $news_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$news_delete->showPageFooter();
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
$news_delete->terminate();
?>