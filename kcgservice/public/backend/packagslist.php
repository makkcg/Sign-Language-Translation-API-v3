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
$packags_list = new packags_list();

// Run the page
$packags_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$packags_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$packags_list->isExport()) { ?>
<script>
var fpackagslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpackagslist = currentForm = new ew.Form("fpackagslist", "list");
	fpackagslist.formKeyCountName = '<?php echo $packags_list->FormKeyCountName ?>';
	loadjs.done("fpackagslist");
});
var fpackagslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpackagslistsrch = currentSearchForm = new ew.Form("fpackagslistsrch");

	// Dynamic selection lists
	// Filters

	fpackagslistsrch.filterList = <?php echo $packags_list->getFilterList() ?>;
	loadjs.done("fpackagslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$packags_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($packags_list->TotalRecords > 0 && $packags_list->ExportOptions->visible()) { ?>
<?php $packags_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($packags_list->ImportOptions->visible()) { ?>
<?php $packags_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($packags_list->SearchOptions->visible()) { ?>
<?php $packags_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($packags_list->FilterOptions->visible()) { ?>
<?php $packags_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$packags_list->renderOtherOptions();
?>
<?php if (!$packags_list->isExport() && !$packags->CurrentAction) { ?>
<form name="fpackagslistsrch" id="fpackagslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpackagslistsrch-search-panel" class="<?php echo $packags_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="packags">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $packags_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($packags_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($packags_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $packags_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($packags_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($packags_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($packags_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($packags_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $packags_list->showPageHeader(); ?>
<?php
$packags_list->showMessage();
?>
<?php if ($packags_list->TotalRecords > 0 || $packags->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($packags_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> packags">
<form name="fpackagslist" id="fpackagslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="packags">
<div id="gmp_packags" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($packags_list->TotalRecords > 0 || $packags_list->isGridEdit()) { ?>
<table id="tbl_packagslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$packags->RowType = ROWTYPE_HEADER;

// Render list options
$packags_list->renderListOptions();

// Render list options (header, left)
$packags_list->ListOptions->render("header", "left");
?>
<?php if ($packags_list->id->Visible) { // id ?>
	<?php if ($packags_list->SortUrl($packags_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $packags_list->id->headerCellClass() ?>"><div id="elh_packags_id" class="packags_id"><div class="ew-table-header-caption"><?php echo $packags_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $packags_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $packags_list->SortUrl($packags_list->id) ?>', 1);"><div id="elh_packags_id" class="packags_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packags_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($packags_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($packags_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packags_list->package->Visible) { // package ?>
	<?php if ($packags_list->SortUrl($packags_list->package) == "") { ?>
		<th data-name="package" class="<?php echo $packags_list->package->headerCellClass() ?>"><div id="elh_packags_package" class="packags_package"><div class="ew-table-header-caption"><?php echo $packags_list->package->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="package" class="<?php echo $packags_list->package->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $packags_list->SortUrl($packags_list->package) ?>', 1);"><div id="elh_packags_package" class="packags_package">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packags_list->package->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($packags_list->package->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($packags_list->package->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packags_list->number_of_words->Visible) { // number_of_words ?>
	<?php if ($packags_list->SortUrl($packags_list->number_of_words) == "") { ?>
		<th data-name="number_of_words" class="<?php echo $packags_list->number_of_words->headerCellClass() ?>"><div id="elh_packags_number_of_words" class="packags_number_of_words"><div class="ew-table-header-caption"><?php echo $packags_list->number_of_words->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="number_of_words" class="<?php echo $packags_list->number_of_words->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $packags_list->SortUrl($packags_list->number_of_words) ?>', 1);"><div id="elh_packags_number_of_words" class="packags_number_of_words">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packags_list->number_of_words->caption() ?></span><span class="ew-table-header-sort"><?php if ($packags_list->number_of_words->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($packags_list->number_of_words->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packags_list->period_in_months->Visible) { // period_in_months ?>
	<?php if ($packags_list->SortUrl($packags_list->period_in_months) == "") { ?>
		<th data-name="period_in_months" class="<?php echo $packags_list->period_in_months->headerCellClass() ?>"><div id="elh_packags_period_in_months" class="packags_period_in_months"><div class="ew-table-header-caption"><?php echo $packags_list->period_in_months->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="period_in_months" class="<?php echo $packags_list->period_in_months->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $packags_list->SortUrl($packags_list->period_in_months) ?>', 1);"><div id="elh_packags_period_in_months" class="packags_period_in_months">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packags_list->period_in_months->caption() ?></span><span class="ew-table-header-sort"><?php if ($packags_list->period_in_months->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($packags_list->period_in_months->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packags_list->connection_points->Visible) { // connection_points ?>
	<?php if ($packags_list->SortUrl($packags_list->connection_points) == "") { ?>
		<th data-name="connection_points" class="<?php echo $packags_list->connection_points->headerCellClass() ?>"><div id="elh_packags_connection_points" class="packags_connection_points"><div class="ew-table-header-caption"><?php echo $packags_list->connection_points->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="connection_points" class="<?php echo $packags_list->connection_points->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $packags_list->SortUrl($packags_list->connection_points) ?>', 1);"><div id="elh_packags_connection_points" class="packags_connection_points">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packags_list->connection_points->caption() ?></span><span class="ew-table-header-sort"><?php if ($packags_list->connection_points->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($packags_list->connection_points->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packags_list->price->Visible) { // price ?>
	<?php if ($packags_list->SortUrl($packags_list->price) == "") { ?>
		<th data-name="price" class="<?php echo $packags_list->price->headerCellClass() ?>"><div id="elh_packags_price" class="packags_price"><div class="ew-table-header-caption"><?php echo $packags_list->price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="price" class="<?php echo $packags_list->price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $packags_list->SortUrl($packags_list->price) ?>', 1);"><div id="elh_packags_price" class="packags_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packags_list->price->caption() ?></span><span class="ew-table-header-sort"><?php if ($packags_list->price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($packags_list->price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packags_list->created_at->Visible) { // created_at ?>
	<?php if ($packags_list->SortUrl($packags_list->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $packags_list->created_at->headerCellClass() ?>"><div id="elh_packags_created_at" class="packags_created_at"><div class="ew-table-header-caption"><?php echo $packags_list->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $packags_list->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $packags_list->SortUrl($packags_list->created_at) ?>', 1);"><div id="elh_packags_created_at" class="packags_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packags_list->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($packags_list->created_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($packags_list->created_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($packags_list->updated_at->Visible) { // updated_at ?>
	<?php if ($packags_list->SortUrl($packags_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $packags_list->updated_at->headerCellClass() ?>"><div id="elh_packags_updated_at" class="packags_updated_at"><div class="ew-table-header-caption"><?php echo $packags_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $packags_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $packags_list->SortUrl($packags_list->updated_at) ?>', 1);"><div id="elh_packags_updated_at" class="packags_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $packags_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($packags_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($packags_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$packags_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($packags_list->ExportAll && $packags_list->isExport()) {
	$packags_list->StopRecord = $packags_list->TotalRecords;
} else {

	// Set the last record to display
	if ($packags_list->TotalRecords > $packags_list->StartRecord + $packags_list->DisplayRecords - 1)
		$packags_list->StopRecord = $packags_list->StartRecord + $packags_list->DisplayRecords - 1;
	else
		$packags_list->StopRecord = $packags_list->TotalRecords;
}
$packags_list->RecordCount = $packags_list->StartRecord - 1;
if ($packags_list->Recordset && !$packags_list->Recordset->EOF) {
	$packags_list->Recordset->moveFirst();
	$selectLimit = $packags_list->UseSelectLimit;
	if (!$selectLimit && $packags_list->StartRecord > 1)
		$packags_list->Recordset->move($packags_list->StartRecord - 1);
} elseif (!$packags->AllowAddDeleteRow && $packags_list->StopRecord == 0) {
	$packags_list->StopRecord = $packags->GridAddRowCount;
}

// Initialize aggregate
$packags->RowType = ROWTYPE_AGGREGATEINIT;
$packags->resetAttributes();
$packags_list->renderRow();
while ($packags_list->RecordCount < $packags_list->StopRecord) {
	$packags_list->RecordCount++;
	if ($packags_list->RecordCount >= $packags_list->StartRecord) {
		$packags_list->RowCount++;

		// Set up key count
		$packags_list->KeyCount = $packags_list->RowIndex;

		// Init row class and style
		$packags->resetAttributes();
		$packags->CssClass = "";
		if ($packags_list->isGridAdd()) {
		} else {
			$packags_list->loadRowValues($packags_list->Recordset); // Load row values
		}
		$packags->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$packags->RowAttrs->merge(["data-rowindex" => $packags_list->RowCount, "id" => "r" . $packags_list->RowCount . "_packags", "data-rowtype" => $packags->RowType]);

		// Render row
		$packags_list->renderRow();

		// Render list options
		$packags_list->renderListOptions();
?>
	<tr <?php echo $packags->rowAttributes() ?>>
<?php

// Render list options (body, left)
$packags_list->ListOptions->render("body", "left", $packags_list->RowCount);
?>
	<?php if ($packags_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $packags_list->id->cellAttributes() ?>>
<span id="el<?php echo $packags_list->RowCount ?>_packags_id">
<span<?php echo $packags_list->id->viewAttributes() ?>><?php echo $packags_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packags_list->package->Visible) { // package ?>
		<td data-name="package" <?php echo $packags_list->package->cellAttributes() ?>>
<span id="el<?php echo $packags_list->RowCount ?>_packags_package">
<span<?php echo $packags_list->package->viewAttributes() ?>><?php echo $packags_list->package->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packags_list->number_of_words->Visible) { // number_of_words ?>
		<td data-name="number_of_words" <?php echo $packags_list->number_of_words->cellAttributes() ?>>
<span id="el<?php echo $packags_list->RowCount ?>_packags_number_of_words">
<span<?php echo $packags_list->number_of_words->viewAttributes() ?>><?php echo $packags_list->number_of_words->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packags_list->period_in_months->Visible) { // period_in_months ?>
		<td data-name="period_in_months" <?php echo $packags_list->period_in_months->cellAttributes() ?>>
<span id="el<?php echo $packags_list->RowCount ?>_packags_period_in_months">
<span<?php echo $packags_list->period_in_months->viewAttributes() ?>><?php echo $packags_list->period_in_months->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packags_list->connection_points->Visible) { // connection_points ?>
		<td data-name="connection_points" <?php echo $packags_list->connection_points->cellAttributes() ?>>
<span id="el<?php echo $packags_list->RowCount ?>_packags_connection_points">
<span<?php echo $packags_list->connection_points->viewAttributes() ?>><?php echo $packags_list->connection_points->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packags_list->price->Visible) { // price ?>
		<td data-name="price" <?php echo $packags_list->price->cellAttributes() ?>>
<span id="el<?php echo $packags_list->RowCount ?>_packags_price">
<span<?php echo $packags_list->price->viewAttributes() ?>><?php echo $packags_list->price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packags_list->created_at->Visible) { // created_at ?>
		<td data-name="created_at" <?php echo $packags_list->created_at->cellAttributes() ?>>
<span id="el<?php echo $packags_list->RowCount ?>_packags_created_at">
<span<?php echo $packags_list->created_at->viewAttributes() ?>><?php echo $packags_list->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($packags_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $packags_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $packags_list->RowCount ?>_packags_updated_at">
<span<?php echo $packags_list->updated_at->viewAttributes() ?>><?php echo $packags_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$packags_list->ListOptions->render("body", "right", $packags_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$packags_list->isGridAdd())
		$packags_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$packags->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($packags_list->Recordset)
	$packags_list->Recordset->Close();
?>
<?php if (!$packags_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$packags_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $packags_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $packags_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($packags_list->TotalRecords == 0 && !$packags->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $packags_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$packags_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$packags_list->isExport()) { ?>
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
$packags_list->terminate();
?>