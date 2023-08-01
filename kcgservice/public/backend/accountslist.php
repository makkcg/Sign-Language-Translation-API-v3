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
$accounts_list = new accounts_list();

// Run the page
$accounts_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$accounts_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$accounts_list->isExport()) { ?>
<script>
var faccountslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	faccountslist = currentForm = new ew.Form("faccountslist", "list");
	faccountslist.formKeyCountName = '<?php echo $accounts_list->FormKeyCountName ?>';
	loadjs.done("faccountslist");
});
var faccountslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	faccountslistsrch = currentSearchForm = new ew.Form("faccountslistsrch");

	// Dynamic selection lists
	// Filters

	faccountslistsrch.filterList = <?php echo $accounts_list->getFilterList() ?>;
	loadjs.done("faccountslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$accounts_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($accounts_list->TotalRecords > 0 && $accounts_list->ExportOptions->visible()) { ?>
<?php $accounts_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($accounts_list->ImportOptions->visible()) { ?>
<?php $accounts_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($accounts_list->SearchOptions->visible()) { ?>
<?php $accounts_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($accounts_list->FilterOptions->visible()) { ?>
<?php $accounts_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$accounts_list->renderOtherOptions();
?>
<?php if (!$accounts_list->isExport() && !$accounts->CurrentAction) { ?>
<form name="faccountslistsrch" id="faccountslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="faccountslistsrch-search-panel" class="<?php echo $accounts_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="accounts">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $accounts_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($accounts_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($accounts_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $accounts_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($accounts_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($accounts_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($accounts_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($accounts_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $accounts_list->showPageHeader(); ?>
<?php
$accounts_list->showMessage();
?>
<?php if ($accounts_list->TotalRecords > 0 || $accounts->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($accounts_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> accounts">
<form name="faccountslist" id="faccountslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="accounts">
<div id="gmp_accounts" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($accounts_list->TotalRecords > 0 || $accounts_list->isGridEdit()) { ?>
<table id="tbl_accountslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$accounts->RowType = ROWTYPE_HEADER;

// Render list options
$accounts_list->renderListOptions();

// Render list options (header, left)
$accounts_list->ListOptions->render("header", "left");
?>
<?php if ($accounts_list->id->Visible) { // id ?>
	<?php if ($accounts_list->SortUrl($accounts_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $accounts_list->id->headerCellClass() ?>"><div id="elh_accounts_id" class="accounts_id"><div class="ew-table-header-caption"><?php echo $accounts_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $accounts_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->id) ?>', 1);"><div id="elh_accounts_id" class="accounts_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->user_id->Visible) { // user_id ?>
	<?php if ($accounts_list->SortUrl($accounts_list->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $accounts_list->user_id->headerCellClass() ?>"><div id="elh_accounts_user_id" class="accounts_user_id"><div class="ew-table-header-caption"><?php echo $accounts_list->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $accounts_list->user_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->user_id) ?>', 1);"><div id="elh_accounts_user_id" class="accounts_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->user_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->user_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->name->Visible) { // name ?>
	<?php if ($accounts_list->SortUrl($accounts_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $accounts_list->name->headerCellClass() ?>"><div id="elh_accounts_name" class="accounts_name"><div class="ew-table-header-caption"><?php echo $accounts_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $accounts_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->name) ?>', 1);"><div id="elh_accounts_name" class="accounts_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->_email->Visible) { // email ?>
	<?php if ($accounts_list->SortUrl($accounts_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $accounts_list->_email->headerCellClass() ?>"><div id="elh_accounts__email" class="accounts__email"><div class="ew-table-header-caption"><?php echo $accounts_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $accounts_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->_email) ?>', 1);"><div id="elh_accounts__email" class="accounts__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->phone->Visible) { // phone ?>
	<?php if ($accounts_list->SortUrl($accounts_list->phone) == "") { ?>
		<th data-name="phone" class="<?php echo $accounts_list->phone->headerCellClass() ?>"><div id="elh_accounts_phone" class="accounts_phone"><div class="ew-table-header-caption"><?php echo $accounts_list->phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="phone" class="<?php echo $accounts_list->phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->phone) ?>', 1);"><div id="elh_accounts_phone" class="accounts_phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->phone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->phone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->words->Visible) { // words ?>
	<?php if ($accounts_list->SortUrl($accounts_list->words) == "") { ?>
		<th data-name="words" class="<?php echo $accounts_list->words->headerCellClass() ?>"><div id="elh_accounts_words" class="accounts_words"><div class="ew-table-header-caption"><?php echo $accounts_list->words->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="words" class="<?php echo $accounts_list->words->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->words) ?>', 1);"><div id="elh_accounts_words" class="accounts_words">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->words->caption() ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->words->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->words->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->used_words->Visible) { // used_words ?>
	<?php if ($accounts_list->SortUrl($accounts_list->used_words) == "") { ?>
		<th data-name="used_words" class="<?php echo $accounts_list->used_words->headerCellClass() ?>"><div id="elh_accounts_used_words" class="accounts_used_words"><div class="ew-table-header-caption"><?php echo $accounts_list->used_words->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="used_words" class="<?php echo $accounts_list->used_words->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->used_words) ?>', 1);"><div id="elh_accounts_used_words" class="accounts_used_words">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->used_words->caption() ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->used_words->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->used_words->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->remain_words->Visible) { // remain_words ?>
	<?php if ($accounts_list->SortUrl($accounts_list->remain_words) == "") { ?>
		<th data-name="remain_words" class="<?php echo $accounts_list->remain_words->headerCellClass() ?>"><div id="elh_accounts_remain_words" class="accounts_remain_words"><div class="ew-table-header-caption"><?php echo $accounts_list->remain_words->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="remain_words" class="<?php echo $accounts_list->remain_words->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->remain_words) ?>', 1);"><div id="elh_accounts_remain_words" class="accounts_remain_words">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->remain_words->caption() ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->remain_words->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->remain_words->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->connection_points->Visible) { // connection_points ?>
	<?php if ($accounts_list->SortUrl($accounts_list->connection_points) == "") { ?>
		<th data-name="connection_points" class="<?php echo $accounts_list->connection_points->headerCellClass() ?>"><div id="elh_accounts_connection_points" class="accounts_connection_points"><div class="ew-table-header-caption"><?php echo $accounts_list->connection_points->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="connection_points" class="<?php echo $accounts_list->connection_points->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->connection_points) ?>', 1);"><div id="elh_accounts_connection_points" class="accounts_connection_points">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->connection_points->caption() ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->connection_points->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->connection_points->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->package->Visible) { // package ?>
	<?php if ($accounts_list->SortUrl($accounts_list->package) == "") { ?>
		<th data-name="package" class="<?php echo $accounts_list->package->headerCellClass() ?>"><div id="elh_accounts_package" class="accounts_package"><div class="ew-table-header-caption"><?php echo $accounts_list->package->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="package" class="<?php echo $accounts_list->package->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->package) ?>', 1);"><div id="elh_accounts_package" class="accounts_package">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->package->caption() ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->package->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->package->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accounts_list->expire_date->Visible) { // expire_date ?>
	<?php if ($accounts_list->SortUrl($accounts_list->expire_date) == "") { ?>
		<th data-name="expire_date" class="<?php echo $accounts_list->expire_date->headerCellClass() ?>"><div id="elh_accounts_expire_date" class="accounts_expire_date"><div class="ew-table-header-caption"><?php echo $accounts_list->expire_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="expire_date" class="<?php echo $accounts_list->expire_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accounts_list->SortUrl($accounts_list->expire_date) ?>', 1);"><div id="elh_accounts_expire_date" class="accounts_expire_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accounts_list->expire_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($accounts_list->expire_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accounts_list->expire_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$accounts_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($accounts_list->ExportAll && $accounts_list->isExport()) {
	$accounts_list->StopRecord = $accounts_list->TotalRecords;
} else {

	// Set the last record to display
	if ($accounts_list->TotalRecords > $accounts_list->StartRecord + $accounts_list->DisplayRecords - 1)
		$accounts_list->StopRecord = $accounts_list->StartRecord + $accounts_list->DisplayRecords - 1;
	else
		$accounts_list->StopRecord = $accounts_list->TotalRecords;
}
$accounts_list->RecordCount = $accounts_list->StartRecord - 1;
if ($accounts_list->Recordset && !$accounts_list->Recordset->EOF) {
	$accounts_list->Recordset->moveFirst();
	$selectLimit = $accounts_list->UseSelectLimit;
	if (!$selectLimit && $accounts_list->StartRecord > 1)
		$accounts_list->Recordset->move($accounts_list->StartRecord - 1);
} elseif (!$accounts->AllowAddDeleteRow && $accounts_list->StopRecord == 0) {
	$accounts_list->StopRecord = $accounts->GridAddRowCount;
}

// Initialize aggregate
$accounts->RowType = ROWTYPE_AGGREGATEINIT;
$accounts->resetAttributes();
$accounts_list->renderRow();
while ($accounts_list->RecordCount < $accounts_list->StopRecord) {
	$accounts_list->RecordCount++;
	if ($accounts_list->RecordCount >= $accounts_list->StartRecord) {
		$accounts_list->RowCount++;

		// Set up key count
		$accounts_list->KeyCount = $accounts_list->RowIndex;

		// Init row class and style
		$accounts->resetAttributes();
		$accounts->CssClass = "";
		if ($accounts_list->isGridAdd()) {
		} else {
			$accounts_list->loadRowValues($accounts_list->Recordset); // Load row values
		}
		$accounts->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$accounts->RowAttrs->merge(["data-rowindex" => $accounts_list->RowCount, "id" => "r" . $accounts_list->RowCount . "_accounts", "data-rowtype" => $accounts->RowType]);

		// Render row
		$accounts_list->renderRow();

		// Render list options
		$accounts_list->renderListOptions();
?>
	<tr <?php echo $accounts->rowAttributes() ?>>
<?php

// Render list options (body, left)
$accounts_list->ListOptions->render("body", "left", $accounts_list->RowCount);
?>
	<?php if ($accounts_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $accounts_list->id->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_id">
<span<?php echo $accounts_list->id->viewAttributes() ?>><?php echo $accounts_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->user_id->Visible) { // user_id ?>
		<td data-name="user_id" <?php echo $accounts_list->user_id->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_user_id">
<span<?php echo $accounts_list->user_id->viewAttributes() ?>><?php echo $accounts_list->user_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $accounts_list->name->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_name">
<span<?php echo $accounts_list->name->viewAttributes() ?>><?php echo $accounts_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $accounts_list->_email->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts__email">
<span<?php echo $accounts_list->_email->viewAttributes() ?>><?php echo $accounts_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->phone->Visible) { // phone ?>
		<td data-name="phone" <?php echo $accounts_list->phone->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_phone">
<span<?php echo $accounts_list->phone->viewAttributes() ?>><?php echo $accounts_list->phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->words->Visible) { // words ?>
		<td data-name="words" <?php echo $accounts_list->words->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_words">
<span<?php echo $accounts_list->words->viewAttributes() ?>><?php echo $accounts_list->words->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->used_words->Visible) { // used_words ?>
		<td data-name="used_words" <?php echo $accounts_list->used_words->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_used_words">
<span<?php echo $accounts_list->used_words->viewAttributes() ?>><?php echo $accounts_list->used_words->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->remain_words->Visible) { // remain_words ?>
		<td data-name="remain_words" <?php echo $accounts_list->remain_words->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_remain_words">
<span<?php echo $accounts_list->remain_words->viewAttributes() ?>><?php echo $accounts_list->remain_words->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->connection_points->Visible) { // connection_points ?>
		<td data-name="connection_points" <?php echo $accounts_list->connection_points->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_connection_points">
<span<?php echo $accounts_list->connection_points->viewAttributes() ?>><?php echo $accounts_list->connection_points->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->package->Visible) { // package ?>
		<td data-name="package" <?php echo $accounts_list->package->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_package">
<span<?php echo $accounts_list->package->viewAttributes() ?>><?php echo $accounts_list->package->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($accounts_list->expire_date->Visible) { // expire_date ?>
		<td data-name="expire_date" <?php echo $accounts_list->expire_date->cellAttributes() ?>>
<span id="el<?php echo $accounts_list->RowCount ?>_accounts_expire_date">
<span<?php echo $accounts_list->expire_date->viewAttributes() ?>><?php echo $accounts_list->expire_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$accounts_list->ListOptions->render("body", "right", $accounts_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$accounts_list->isGridAdd())
		$accounts_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$accounts->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($accounts_list->Recordset)
	$accounts_list->Recordset->Close();
?>
<?php if (!$accounts_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$accounts_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $accounts_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $accounts_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($accounts_list->TotalRecords == 0 && !$accounts->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $accounts_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$accounts_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$accounts_list->isExport()) { ?>
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
$accounts_list->terminate();
?>