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
$news_list = new news_list();

// Run the page
$news_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$news_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$news_list->isExport()) { ?>
<script>
var fnewslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fnewslist = currentForm = new ew.Form("fnewslist", "list");
	fnewslist.formKeyCountName = '<?php echo $news_list->FormKeyCountName ?>';
	loadjs.done("fnewslist");
});
var fnewslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fnewslistsrch = currentSearchForm = new ew.Form("fnewslistsrch");

	// Dynamic selection lists
	// Filters

	fnewslistsrch.filterList = <?php echo $news_list->getFilterList() ?>;
	loadjs.done("fnewslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$news_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($news_list->TotalRecords > 0 && $news_list->ExportOptions->visible()) { ?>
<?php $news_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($news_list->ImportOptions->visible()) { ?>
<?php $news_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($news_list->SearchOptions->visible()) { ?>
<?php $news_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($news_list->FilterOptions->visible()) { ?>
<?php $news_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$news_list->renderOtherOptions();
?>
<?php if (!$news_list->isExport() && !$news->CurrentAction) { ?>
<form name="fnewslistsrch" id="fnewslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fnewslistsrch-search-panel" class="<?php echo $news_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="news">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $news_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($news_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($news_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $news_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($news_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($news_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($news_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($news_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $news_list->showPageHeader(); ?>
<?php
$news_list->showMessage();
?>
<?php if ($news_list->TotalRecords > 0 || $news->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($news_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> news">
<form name="fnewslist" id="fnewslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="news">
<div id="gmp_news" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($news_list->TotalRecords > 0 || $news_list->isGridEdit()) { ?>
<table id="tbl_newslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$news->RowType = ROWTYPE_HEADER;

// Render list options
$news_list->renderListOptions();

// Render list options (header, left)
$news_list->ListOptions->render("header", "left");
?>
<?php if ($news_list->id->Visible) { // id ?>
	<?php if ($news_list->SortUrl($news_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $news_list->id->headerCellClass() ?>"><div id="elh_news_id" class="news_id"><div class="ew-table-header-caption"><?php echo $news_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $news_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $news_list->SortUrl($news_list->id) ?>', 1);"><div id="elh_news_id" class="news_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $news_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($news_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($news_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($news_list->title->Visible) { // title ?>
	<?php if ($news_list->SortUrl($news_list->title) == "") { ?>
		<th data-name="title" class="<?php echo $news_list->title->headerCellClass() ?>"><div id="elh_news_title" class="news_title"><div class="ew-table-header-caption"><?php echo $news_list->title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="title" class="<?php echo $news_list->title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $news_list->SortUrl($news_list->title) ?>', 1);"><div id="elh_news_title" class="news_title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $news_list->title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($news_list->title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($news_list->title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($news_list->image->Visible) { // image ?>
	<?php if ($news_list->SortUrl($news_list->image) == "") { ?>
		<th data-name="image" class="<?php echo $news_list->image->headerCellClass() ?>"><div id="elh_news_image" class="news_image"><div class="ew-table-header-caption"><?php echo $news_list->image->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="image" class="<?php echo $news_list->image->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $news_list->SortUrl($news_list->image) ?>', 1);"><div id="elh_news_image" class="news_image">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $news_list->image->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($news_list->image->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($news_list->image->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($news_list->report->Visible) { // report ?>
	<?php if ($news_list->SortUrl($news_list->report) == "") { ?>
		<th data-name="report" class="<?php echo $news_list->report->headerCellClass() ?>"><div id="elh_news_report" class="news_report"><div class="ew-table-header-caption"><?php echo $news_list->report->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="report" class="<?php echo $news_list->report->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $news_list->SortUrl($news_list->report) ?>', 1);"><div id="elh_news_report" class="news_report">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $news_list->report->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($news_list->report->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($news_list->report->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$news_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($news_list->ExportAll && $news_list->isExport()) {
	$news_list->StopRecord = $news_list->TotalRecords;
} else {

	// Set the last record to display
	if ($news_list->TotalRecords > $news_list->StartRecord + $news_list->DisplayRecords - 1)
		$news_list->StopRecord = $news_list->StartRecord + $news_list->DisplayRecords - 1;
	else
		$news_list->StopRecord = $news_list->TotalRecords;
}
$news_list->RecordCount = $news_list->StartRecord - 1;
if ($news_list->Recordset && !$news_list->Recordset->EOF) {
	$news_list->Recordset->moveFirst();
	$selectLimit = $news_list->UseSelectLimit;
	if (!$selectLimit && $news_list->StartRecord > 1)
		$news_list->Recordset->move($news_list->StartRecord - 1);
} elseif (!$news->AllowAddDeleteRow && $news_list->StopRecord == 0) {
	$news_list->StopRecord = $news->GridAddRowCount;
}

// Initialize aggregate
$news->RowType = ROWTYPE_AGGREGATEINIT;
$news->resetAttributes();
$news_list->renderRow();
while ($news_list->RecordCount < $news_list->StopRecord) {
	$news_list->RecordCount++;
	if ($news_list->RecordCount >= $news_list->StartRecord) {
		$news_list->RowCount++;

		// Set up key count
		$news_list->KeyCount = $news_list->RowIndex;

		// Init row class and style
		$news->resetAttributes();
		$news->CssClass = "";
		if ($news_list->isGridAdd()) {
		} else {
			$news_list->loadRowValues($news_list->Recordset); // Load row values
		}
		$news->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$news->RowAttrs->merge(["data-rowindex" => $news_list->RowCount, "id" => "r" . $news_list->RowCount . "_news", "data-rowtype" => $news->RowType]);

		// Render row
		$news_list->renderRow();

		// Render list options
		$news_list->renderListOptions();
?>
	<tr <?php echo $news->rowAttributes() ?>>
<?php

// Render list options (body, left)
$news_list->ListOptions->render("body", "left", $news_list->RowCount);
?>
	<?php if ($news_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $news_list->id->cellAttributes() ?>>
<span id="el<?php echo $news_list->RowCount ?>_news_id">
<span<?php echo $news_list->id->viewAttributes() ?>><?php echo $news_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($news_list->title->Visible) { // title ?>
		<td data-name="title" <?php echo $news_list->title->cellAttributes() ?>>
<span id="el<?php echo $news_list->RowCount ?>_news_title">
<span<?php echo $news_list->title->viewAttributes() ?>><?php echo $news_list->title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($news_list->image->Visible) { // image ?>
		<td data-name="image" <?php echo $news_list->image->cellAttributes() ?>>
<span id="el<?php echo $news_list->RowCount ?>_news_image">
<span<?php echo $news_list->image->viewAttributes() ?>><?php echo $news_list->image->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($news_list->report->Visible) { // report ?>
		<td data-name="report" <?php echo $news_list->report->cellAttributes() ?>>
<span id="el<?php echo $news_list->RowCount ?>_news_report">
<span<?php echo $news_list->report->viewAttributes() ?>><?php echo $news_list->report->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$news_list->ListOptions->render("body", "right", $news_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$news_list->isGridAdd())
		$news_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$news->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($news_list->Recordset)
	$news_list->Recordset->Close();
?>
<?php if (!$news_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$news_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $news_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $news_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($news_list->TotalRecords == 0 && !$news->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $news_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$news_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$news_list->isExport()) { ?>
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
$news_list->terminate();
?>