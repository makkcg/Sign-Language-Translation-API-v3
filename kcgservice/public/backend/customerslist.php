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
$customers_list = new customers_list();

// Run the page
$customers_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$customers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$customers_list->isExport()) { ?>
<script>
var fcustomerslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcustomerslist = currentForm = new ew.Form("fcustomerslist", "list");
	fcustomerslist.formKeyCountName = '<?php echo $customers_list->FormKeyCountName ?>';
	loadjs.done("fcustomerslist");
});
var fcustomerslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcustomerslistsrch = currentSearchForm = new ew.Form("fcustomerslistsrch");

	// Dynamic selection lists
	// Filters

	fcustomerslistsrch.filterList = <?php echo $customers_list->getFilterList() ?>;
	loadjs.done("fcustomerslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$customers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($customers_list->TotalRecords > 0 && $customers_list->ExportOptions->visible()) { ?>
<?php $customers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->ImportOptions->visible()) { ?>
<?php $customers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->SearchOptions->visible()) { ?>
<?php $customers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($customers_list->FilterOptions->visible()) { ?>
<?php $customers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$customers_list->renderOtherOptions();
?>
<?php if (!$customers_list->isExport() && !$customers->CurrentAction) { ?>
<form name="fcustomerslistsrch" id="fcustomerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcustomerslistsrch-search-panel" class="<?php echo $customers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="customers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $customers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($customers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($customers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $customers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($customers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $customers_list->showPageHeader(); ?>
<?php
$customers_list->showMessage();
?>
<?php if ($customers_list->TotalRecords > 0 || $customers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($customers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> customers">
<form name="fcustomerslist" id="fcustomerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="customers">
<div id="gmp_customers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($customers_list->TotalRecords > 0 || $customers_list->isGridEdit()) { ?>
<table id="tbl_customerslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$customers->RowType = ROWTYPE_HEADER;

// Render list options
$customers_list->renderListOptions();

// Render list options (header, left)
$customers_list->ListOptions->render("header", "left");
?>
<?php if ($customers_list->id->Visible) { // id ?>
	<?php if ($customers_list->SortUrl($customers_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $customers_list->id->headerCellClass() ?>"><div id="elh_customers_id" class="customers_id"><div class="ew-table-header-caption"><?php echo $customers_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $customers_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->id) ?>', 1);"><div id="elh_customers_id" class="customers_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($customers_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_id->Visible) { // customer_id ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_id) == "") { ?>
		<th data-name="customer_id" class="<?php echo $customers_list->customer_id->headerCellClass() ?>"><div id="elh_customers_customer_id" class="customers_customer_id"><div class="ew-table-header-caption"><?php echo $customers_list->customer_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_id" class="<?php echo $customers_list->customer_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_id) ?>', 1);"><div id="elh_customers_customer_id" class="customers_customer_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->customer_name->Visible) { // customer_name ?>
	<?php if ($customers_list->SortUrl($customers_list->customer_name) == "") { ?>
		<th data-name="customer_name" class="<?php echo $customers_list->customer_name->headerCellClass() ?>"><div id="elh_customers_customer_name" class="customers_customer_name"><div class="ew-table-header-caption"><?php echo $customers_list->customer_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="customer_name" class="<?php echo $customers_list->customer_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->customer_name) ?>', 1);"><div id="elh_customers_customer_name" class="customers_customer_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->customer_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->customer_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->customer_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->current_package->Visible) { // current_package ?>
	<?php if ($customers_list->SortUrl($customers_list->current_package) == "") { ?>
		<th data-name="current_package" class="<?php echo $customers_list->current_package->headerCellClass() ?>"><div id="elh_customers_current_package" class="customers_current_package"><div class="ew-table-header-caption"><?php echo $customers_list->current_package->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="current_package" class="<?php echo $customers_list->current_package->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->current_package) ?>', 1);"><div id="elh_customers_current_package" class="customers_current_package">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->current_package->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->current_package->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->current_package->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->remaine_words->Visible) { // remaine_words ?>
	<?php if ($customers_list->SortUrl($customers_list->remaine_words) == "") { ?>
		<th data-name="remaine_words" class="<?php echo $customers_list->remaine_words->headerCellClass() ?>"><div id="elh_customers_remaine_words" class="customers_remaine_words"><div class="ew-table-header-caption"><?php echo $customers_list->remaine_words->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="remaine_words" class="<?php echo $customers_list->remaine_words->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->remaine_words) ?>', 1);"><div id="elh_customers_remaine_words" class="customers_remaine_words">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->remaine_words->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($customers_list->remaine_words->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->remaine_words->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($customers_list->expiration->Visible) { // expiration ?>
	<?php if ($customers_list->SortUrl($customers_list->expiration) == "") { ?>
		<th data-name="expiration" class="<?php echo $customers_list->expiration->headerCellClass() ?>"><div id="elh_customers_expiration" class="customers_expiration"><div class="ew-table-header-caption"><?php echo $customers_list->expiration->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="expiration" class="<?php echo $customers_list->expiration->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $customers_list->SortUrl($customers_list->expiration) ?>', 1);"><div id="elh_customers_expiration" class="customers_expiration">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $customers_list->expiration->caption() ?></span><span class="ew-table-header-sort"><?php if ($customers_list->expiration->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($customers_list->expiration->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$customers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($customers_list->ExportAll && $customers_list->isExport()) {
	$customers_list->StopRecord = $customers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($customers_list->TotalRecords > $customers_list->StartRecord + $customers_list->DisplayRecords - 1)
		$customers_list->StopRecord = $customers_list->StartRecord + $customers_list->DisplayRecords - 1;
	else
		$customers_list->StopRecord = $customers_list->TotalRecords;
}
$customers_list->RecordCount = $customers_list->StartRecord - 1;
if ($customers_list->Recordset && !$customers_list->Recordset->EOF) {
	$customers_list->Recordset->moveFirst();
	$selectLimit = $customers_list->UseSelectLimit;
	if (!$selectLimit && $customers_list->StartRecord > 1)
		$customers_list->Recordset->move($customers_list->StartRecord - 1);
} elseif (!$customers->AllowAddDeleteRow && $customers_list->StopRecord == 0) {
	$customers_list->StopRecord = $customers->GridAddRowCount;
}

// Initialize aggregate
$customers->RowType = ROWTYPE_AGGREGATEINIT;
$customers->resetAttributes();
$customers_list->renderRow();
while ($customers_list->RecordCount < $customers_list->StopRecord) {
	$customers_list->RecordCount++;
	if ($customers_list->RecordCount >= $customers_list->StartRecord) {
		$customers_list->RowCount++;

		// Set up key count
		$customers_list->KeyCount = $customers_list->RowIndex;

		// Init row class and style
		$customers->resetAttributes();
		$customers->CssClass = "";
		if ($customers_list->isGridAdd()) {
		} else {
			$customers_list->loadRowValues($customers_list->Recordset); // Load row values
		}
		$customers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$customers->RowAttrs->merge(["data-rowindex" => $customers_list->RowCount, "id" => "r" . $customers_list->RowCount . "_customers", "data-rowtype" => $customers->RowType]);

		// Render row
		$customers_list->renderRow();

		// Render list options
		$customers_list->renderListOptions();
?>
	<tr <?php echo $customers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$customers_list->ListOptions->render("body", "left", $customers_list->RowCount);
?>
	<?php if ($customers_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $customers_list->id->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_id">
<span<?php echo $customers_list->id->viewAttributes() ?>><?php echo $customers_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_id->Visible) { // customer_id ?>
		<td data-name="customer_id" <?php echo $customers_list->customer_id->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_id">
<span<?php echo $customers_list->customer_id->viewAttributes() ?>><?php echo $customers_list->customer_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->customer_name->Visible) { // customer_name ?>
		<td data-name="customer_name" <?php echo $customers_list->customer_name->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_customer_name">
<span<?php echo $customers_list->customer_name->viewAttributes() ?>><?php echo $customers_list->customer_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->current_package->Visible) { // current_package ?>
		<td data-name="current_package" <?php echo $customers_list->current_package->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_current_package">
<span<?php echo $customers_list->current_package->viewAttributes() ?>><?php echo $customers_list->current_package->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->remaine_words->Visible) { // remaine_words ?>
		<td data-name="remaine_words" <?php echo $customers_list->remaine_words->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_remaine_words">
<span<?php echo $customers_list->remaine_words->viewAttributes() ?>><?php echo $customers_list->remaine_words->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($customers_list->expiration->Visible) { // expiration ?>
		<td data-name="expiration" <?php echo $customers_list->expiration->cellAttributes() ?>>
<span id="el<?php echo $customers_list->RowCount ?>_customers_expiration">
<span<?php echo $customers_list->expiration->viewAttributes() ?>><?php echo $customers_list->expiration->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$customers_list->ListOptions->render("body", "right", $customers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$customers_list->isGridAdd())
		$customers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$customers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($customers_list->Recordset)
	$customers_list->Recordset->Close();
?>
<?php if (!$customers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$customers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $customers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $customers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($customers_list->TotalRecords == 0 && !$customers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $customers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$customers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$customers_list->isExport()) { ?>
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
$customers_list->terminate();
?>