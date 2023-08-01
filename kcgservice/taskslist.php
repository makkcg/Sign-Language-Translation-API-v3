<?php
namespace PHPMaker2020\contracting;
include "../dbconfig.php";
$sql="SELECT `hour_rate_cost`, `hour_rate_price` FROM `rates`";
$res= mysqli_query($conn,$sql);
$hourcost="0";
$hourprice="0";

if($rr=$res->fetch_row())
	 {
	 $hourcost=strval($rr[0]);
	 $hourprice=strval($rr[1]);
	 }
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
$tasks_list = new tasks_list();

// Run the page
$tasks_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tasks_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tasks_list->isExport()) { ?>
<script>
var ftaskslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftaskslist = currentForm = new ew.Form("ftaskslist", "list");
	ftaskslist.formKeyCountName = '<?php echo $tasks_list->FormKeyCountName ?>';
	loadjs.done("ftaskslist");
});
var ftaskslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftaskslistsrch = currentSearchForm = new ew.Form("ftaskslistsrch");

	// Dynamic selection lists
	// Filters

	ftaskslistsrch.filterList = <?php echo $tasks_list->getFilterList() ?>;
	loadjs.done("ftaskslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<form style="margin-bottom:30px;" method="post" action="changerates.php">
<div style="margin-top:10px;">
<span>hour rate cost</span>
<input style="margin-left:4px;" class="form-control" type="text" name="hourcost" id="hourcost" value="<?php echo $hourcost; ?>">
</div>
<div style="margin-top:10px;">
<span>hour rate price</span>
<input class="form-control" type="text" name="hourprice" id="hourprice" value="<?php echo $hourprice; ?>">
</div>
<div style="margin-top:10px;">
<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit">Submit</button>
</div>
</form>
<?php if (!$tasks_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tasks_list->TotalRecords > 0 && $tasks_list->ExportOptions->visible()) { ?>
<?php $tasks_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tasks_list->ImportOptions->visible()) { ?>
<?php $tasks_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tasks_list->SearchOptions->visible()) { ?>
<?php $tasks_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tasks_list->FilterOptions->visible()) { ?>
<?php $tasks_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tasks_list->renderOtherOptions();
?>
<?php if (!$tasks_list->isExport() && !$tasks->CurrentAction) { ?>
<form name="ftaskslistsrch" id="ftaskslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftaskslistsrch-search-panel" class="<?php echo $tasks_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tasks">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tasks_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tasks_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tasks_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tasks_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tasks_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tasks_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tasks_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tasks_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $tasks_list->showPageHeader(); ?>
<?php
$tasks_list->showMessage();
?>
<?php if ($tasks_list->TotalRecords > 0 || $tasks->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tasks_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tasks">
<form name="ftaskslist" id="ftaskslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tasks">
<div id="gmp_tasks" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tasks_list->TotalRecords > 0 || $tasks_list->isGridEdit()) { ?>
<table id="tbl_taskslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tasks->RowType = ROWTYPE_HEADER;

// Render list options
$tasks_list->renderListOptions();

// Render list options (header, left)
$tasks_list->ListOptions->render("header", "left");
?>
<?php if ($tasks_list->id->Visible) { // id ?>
	<?php if ($tasks_list->SortUrl($tasks_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $tasks_list->id->headerCellClass() ?>"><div id="elh_tasks_id" class="tasks_id"><div class="ew-table-header-caption"><?php echo $tasks_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $tasks_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->id) ?>', 1);"><div id="elh_tasks_id" class="tasks_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->task->Visible) { // task ?>
	<?php if ($tasks_list->SortUrl($tasks_list->task) == "") { ?>
		<th data-name="task" class="<?php echo $tasks_list->task->headerCellClass() ?>"><div id="elh_tasks_task" class="tasks_task"><div class="ew-table-header-caption"><?php echo $tasks_list->task->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="task" class="<?php echo $tasks_list->task->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->task) ?>', 1);"><div id="elh_tasks_task" class="tasks_task">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->task->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->task->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->task->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->task_type->Visible) { // task_type ?>
	<?php if ($tasks_list->SortUrl($tasks_list->task_type) == "") { ?>
		<th data-name="task_type" class="<?php echo $tasks_list->task_type->headerCellClass() ?>"><div id="elh_tasks_task_type" class="tasks_task_type"><div class="ew-table-header-caption"><?php echo $tasks_list->task_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="task_type" class="<?php echo $tasks_list->task_type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->task_type) ?>', 1);"><div id="elh_tasks_task_type" class="tasks_task_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->task_type->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->task_type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->task_type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->min_time->Visible) { // min_time ?>
	<?php if ($tasks_list->SortUrl($tasks_list->min_time) == "") { ?>
		<th data-name="min_time" class="<?php echo $tasks_list->min_time->headerCellClass() ?>"><div id="elh_tasks_min_time" class="tasks_min_time"><div class="ew-table-header-caption"><?php echo $tasks_list->min_time->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="min_time" class="<?php echo $tasks_list->min_time->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->min_time) ?>', 1);"><div id="elh_tasks_min_time" class="tasks_min_time">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->min_time->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->min_time->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->min_time->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->max_time->Visible) { // max_time ?>
	<?php if ($tasks_list->SortUrl($tasks_list->max_time) == "") { ?>
		<th data-name="max_time" class="<?php echo $tasks_list->max_time->headerCellClass() ?>"><div id="elh_tasks_max_time" class="tasks_max_time"><div class="ew-table-header-caption"><?php echo $tasks_list->max_time->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="max_time" class="<?php echo $tasks_list->max_time->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->max_time) ?>', 1);"><div id="elh_tasks_max_time" class="tasks_max_time">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->max_time->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->max_time->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->max_time->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->points->Visible) { // points ?>
	<?php if ($tasks_list->SortUrl($tasks_list->points) == "") { ?>
		<th data-name="points" class="<?php echo $tasks_list->points->headerCellClass() ?>"><div id="elh_tasks_points" class="tasks_points"><div class="ew-table-header-caption"><?php echo $tasks_list->points->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="points" class="<?php echo $tasks_list->points->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->points) ?>', 1);"><div id="elh_tasks_points" class="tasks_points">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->points->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->points->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->points->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->min_price->Visible) { // min_price ?>
	<?php if ($tasks_list->SortUrl($tasks_list->min_price) == "") { ?>
		<th data-name="min_price" class="<?php echo $tasks_list->min_price->headerCellClass() ?>"><div id="elh_tasks_min_price" class="tasks_min_price"><div class="ew-table-header-caption"><?php echo $tasks_list->min_price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="min_price" class="<?php echo $tasks_list->min_price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->min_price) ?>', 1);"><div id="elh_tasks_min_price" class="tasks_min_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->min_price->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->min_price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->min_price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->max_price->Visible) { // max_price ?>
	<?php if ($tasks_list->SortUrl($tasks_list->max_price) == "") { ?>
		<th data-name="max_price" class="<?php echo $tasks_list->max_price->headerCellClass() ?>"><div id="elh_tasks_max_price" class="tasks_max_price"><div class="ew-table-header-caption"><?php echo $tasks_list->max_price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="max_price" class="<?php echo $tasks_list->max_price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->max_price) ?>', 1);"><div id="elh_tasks_max_price" class="tasks_max_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->max_price->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->max_price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->max_price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->min_cost->Visible) { // min_cost ?>
	<?php if ($tasks_list->SortUrl($tasks_list->min_cost) == "") { ?>
		<th data-name="min_cost" class="<?php echo $tasks_list->min_cost->headerCellClass() ?>"><div id="elh_tasks_min_cost" class="tasks_min_cost"><div class="ew-table-header-caption"><?php echo $tasks_list->min_cost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="min_cost" class="<?php echo $tasks_list->min_cost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->min_cost) ?>', 1);"><div id="elh_tasks_min_cost" class="tasks_min_cost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->min_cost->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->min_cost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->min_cost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tasks_list->max_cost->Visible) { // max_cost ?>
	<?php if ($tasks_list->SortUrl($tasks_list->max_cost) == "") { ?>
		<th data-name="max_cost" class="<?php echo $tasks_list->max_cost->headerCellClass() ?>"><div id="elh_tasks_max_cost" class="tasks_max_cost"><div class="ew-table-header-caption"><?php echo $tasks_list->max_cost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="max_cost" class="<?php echo $tasks_list->max_cost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tasks_list->SortUrl($tasks_list->max_cost) ?>', 1);"><div id="elh_tasks_max_cost" class="tasks_max_cost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tasks_list->max_cost->caption() ?></span><span class="ew-table-header-sort"><?php if ($tasks_list->max_cost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tasks_list->max_cost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tasks_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tasks_list->ExportAll && $tasks_list->isExport()) {
	$tasks_list->StopRecord = $tasks_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tasks_list->TotalRecords > $tasks_list->StartRecord + $tasks_list->DisplayRecords - 1)
		$tasks_list->StopRecord = $tasks_list->StartRecord + $tasks_list->DisplayRecords - 1;
	else
		$tasks_list->StopRecord = $tasks_list->TotalRecords;
}
$tasks_list->RecordCount = $tasks_list->StartRecord - 1;
if ($tasks_list->Recordset && !$tasks_list->Recordset->EOF) {
	$tasks_list->Recordset->moveFirst();
	$selectLimit = $tasks_list->UseSelectLimit;
	if (!$selectLimit && $tasks_list->StartRecord > 1)
		$tasks_list->Recordset->move($tasks_list->StartRecord - 1);
} elseif (!$tasks->AllowAddDeleteRow && $tasks_list->StopRecord == 0) {
	$tasks_list->StopRecord = $tasks->GridAddRowCount;
}

// Initialize aggregate
$tasks->RowType = ROWTYPE_AGGREGATEINIT;
$tasks->resetAttributes();
$tasks_list->renderRow();
while ($tasks_list->RecordCount < $tasks_list->StopRecord) {
	$tasks_list->RecordCount++;
	if ($tasks_list->RecordCount >= $tasks_list->StartRecord) {
		$tasks_list->RowCount++;

		// Set up key count
		$tasks_list->KeyCount = $tasks_list->RowIndex;

		// Init row class and style
		$tasks->resetAttributes();
		$tasks->CssClass = "";
		if ($tasks_list->isGridAdd()) {
		} else {
			$tasks_list->loadRowValues($tasks_list->Recordset); // Load row values
		}
		$tasks->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tasks->RowAttrs->merge(["data-rowindex" => $tasks_list->RowCount, "id" => "r" . $tasks_list->RowCount . "_tasks", "data-rowtype" => $tasks->RowType]);

		// Render row
		$tasks_list->renderRow();

		// Render list options
		$tasks_list->renderListOptions();
?>
	<tr <?php echo $tasks->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tasks_list->ListOptions->render("body", "left", $tasks_list->RowCount);
?>
	<?php if ($tasks_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $tasks_list->id->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_id">
<span<?php echo $tasks_list->id->viewAttributes() ?>><?php echo $tasks_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->task->Visible) { // task ?>
		<td data-name="task" <?php echo $tasks_list->task->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_task">
<span<?php echo $tasks_list->task->viewAttributes() ?>><?php echo $tasks_list->task->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->task_type->Visible) { // task_type ?>
		<td data-name="task_type" <?php echo $tasks_list->task_type->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_task_type">
<span<?php echo $tasks_list->task_type->viewAttributes() ?>><?php echo $tasks_list->task_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->min_time->Visible) { // min_time ?>
		<td data-name="min_time" <?php echo $tasks_list->min_time->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_min_time">
<span<?php echo $tasks_list->min_time->viewAttributes() ?>><?php echo $tasks_list->min_time->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->max_time->Visible) { // max_time ?>
		<td data-name="max_time" <?php echo $tasks_list->max_time->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_max_time">
<span<?php echo $tasks_list->max_time->viewAttributes() ?>><?php echo $tasks_list->max_time->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->points->Visible) { // points ?>
		<td data-name="points" <?php echo $tasks_list->points->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_points">
<span<?php echo $tasks_list->points->viewAttributes() ?>><?php echo $tasks_list->points->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->min_price->Visible) { // min_price ?>
		<td data-name="min_price" <?php echo $tasks_list->min_price->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_min_price">
<span<?php echo $tasks_list->min_price->viewAttributes() ?>><?php echo $tasks_list->min_price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->max_price->Visible) { // max_price ?>
		<td data-name="max_price" <?php echo $tasks_list->max_price->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_max_price">
<span<?php echo $tasks_list->max_price->viewAttributes() ?>><?php echo $tasks_list->max_price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->min_cost->Visible) { // min_cost ?>
		<td data-name="min_cost" <?php echo $tasks_list->min_cost->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_min_cost">
<span<?php echo $tasks_list->min_cost->viewAttributes() ?>><?php echo $tasks_list->min_cost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tasks_list->max_cost->Visible) { // max_cost ?>
		<td data-name="max_cost" <?php echo $tasks_list->max_cost->cellAttributes() ?>>
<span id="el<?php echo $tasks_list->RowCount ?>_tasks_max_cost">
<span<?php echo $tasks_list->max_cost->viewAttributes() ?>><?php echo $tasks_list->max_cost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tasks_list->ListOptions->render("body", "right", $tasks_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tasks_list->isGridAdd())
		$tasks_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tasks->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tasks_list->Recordset)
	$tasks_list->Recordset->Close();
?>
<?php if (!$tasks_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tasks_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tasks_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tasks_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tasks_list->TotalRecords == 0 && !$tasks->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tasks_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tasks_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tasks_list->isExport()) { ?>
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
$tasks_list->terminate();
?>