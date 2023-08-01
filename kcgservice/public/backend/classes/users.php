<?php namespace PHPMaker2020\signwords; ?>
<?php

/**
 * Table class for users
 */
class users extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $name;
	public $_email;
	public $phone;
	public $email_verified_at;
	public $pwd;
	public $package;
	public $remember_token;
	public $created_at;
	public $updated_at;
	public $role;
	public $_token;
	public $password;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'users';
		$this->TableName = 'users';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`users`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('users', 'users', 'x_id', 'id', '`id`', '`id`', 21, 20, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// name
		$this->name = new DbField('users', 'users', 'x_name', 'name', '`name`', '`name`', 200, 191, -1, FALSE, '`name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->name->Nullable = FALSE; // NOT NULL field
		$this->name->Required = TRUE; // Required field
		$this->name->Sortable = TRUE; // Allow sort
		$this->fields['name'] = &$this->name;

		// email
		$this->_email = new DbField('users', 'users', 'x__email', 'email', '`email`', '`email`', 200, 191, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Nullable = FALSE; // NOT NULL field
		$this->_email->Required = TRUE; // Required field
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;

		// phone
		$this->phone = new DbField('users', 'users', 'x_phone', 'phone', '`phone`', '`phone`', 200, 191, -1, FALSE, '`phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phone->Sortable = TRUE; // Allow sort
		$this->fields['phone'] = &$this->phone;

		// email_verified_at
		$this->email_verified_at = new DbField('users', 'users', 'x_email_verified_at', 'email_verified_at', '`email_verified_at`', CastDateFieldForLike("`email_verified_at`", 0, "DB"), 135, 19, 0, FALSE, '`email_verified_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->email_verified_at->Sortable = FALSE; // Allow sort
		$this->email_verified_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['email_verified_at'] = &$this->email_verified_at;

		// pwd
		$this->pwd = new DbField('users', 'users', 'x_pwd', 'pwd', '`pwd`', '`pwd`', 200, 191, -1, FALSE, '`pwd`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pwd->Sortable = TRUE; // Allow sort
		$this->fields['pwd'] = &$this->pwd;

		// package
		$this->package = new DbField('users', 'users', 'x_package', 'package', '`package`', '`package`', 200, 191, -1, FALSE, '`package`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->package->Sortable = TRUE; // Allow sort
		$this->package->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->package->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->package->Lookup = new Lookup('package', 'packags', FALSE, 'package', ["package","","",""], [], [], [], [], [], [], '', '');
		$this->fields['package'] = &$this->package;

		// remember_token
		$this->remember_token = new DbField('users', 'users', 'x_remember_token', 'remember_token', '`remember_token`', '`remember_token`', 200, 100, -1, FALSE, '`remember_token`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->remember_token->Sortable = FALSE; // Allow sort
		$this->fields['remember_token'] = &$this->remember_token;

		// created_at
		$this->created_at = new DbField('users', 'users', 'x_created_at', 'created_at', '`created_at`', CastDateFieldForLike("`created_at`", 0, "DB"), 135, 19, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = FALSE; // Allow sort
		$this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// updated_at
		$this->updated_at = new DbField('users', 'users', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike("`updated_at`", 0, "DB"), 135, 19, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updated_at->Sortable = FALSE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// role
		$this->role = new DbField('users', 'users', 'x_role', 'role', '`role`', '`role`', 3, 11, -1, FALSE, '`role`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->role->Nullable = FALSE; // NOT NULL field
		$this->role->Required = TRUE; // Required field
		$this->role->Sortable = TRUE; // Allow sort
		$this->role->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->role->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->role->Lookup = new Lookup('role', 'users', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->role->OptionCount = 2;
		$this->role->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['role'] = &$this->role;

		// token
		$this->_token = new DbField('users', 'users', 'x__token', 'token', '`token`', '`token`', 200, 255, -1, FALSE, '`token`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_token->Sortable = FALSE; // Allow sort
		$this->fields['token'] = &$this->_token;

		// password
		$this->password = new DbField('users', 'users', 'x_password', 'password', '`password`', '`password`', 200, 191, -1, FALSE, '`password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->password->Required = TRUE; // Required field
		$this->password->Sortable = FALSE; // Allow sort
		$this->fields['password'] = &$this->password;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`users`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->name->DbValue = $row['name'];
		$this->_email->DbValue = $row['email'];
		$this->phone->DbValue = $row['phone'];
		$this->email_verified_at->DbValue = $row['email_verified_at'];
		$this->pwd->DbValue = $row['pwd'];
		$this->package->DbValue = $row['package'];
		$this->remember_token->DbValue = $row['remember_token'];
		$this->created_at->DbValue = $row['created_at'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->role->DbValue = $row['role'];
		$this->_token->DbValue = $row['token'];
		$this->password->DbValue = $row['password'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "userslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "usersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "usersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "usersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "userslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("usersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("usersview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "usersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "usersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("usersedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("usersadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("usersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->name->setDbValue($rs->fields('name'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->phone->setDbValue($rs->fields('phone'));
		$this->email_verified_at->setDbValue($rs->fields('email_verified_at'));
		$this->pwd->setDbValue($rs->fields('pwd'));
		$this->package->setDbValue($rs->fields('package'));
		$this->remember_token->setDbValue($rs->fields('remember_token'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->role->setDbValue($rs->fields('role'));
		$this->_token->setDbValue($rs->fields('token'));
		$this->password->setDbValue($rs->fields('password'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// name
		// email
		// phone
		// email_verified_at

		$this->email_verified_at->CellCssStyle = "white-space: nowrap;";

		// pwd
		// package
		// remember_token

		$this->remember_token->CellCssStyle = "white-space: nowrap;";

		// created_at
		$this->created_at->CellCssStyle = "white-space: nowrap;";

		// updated_at
		$this->updated_at->CellCssStyle = "white-space: nowrap;";

		// role
		// token

		$this->_token->CellCssStyle = "white-space: nowrap;";

		// password
		$this->password->CellCssStyle = "white-space: nowrap;";

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// email_verified_at
		$this->email_verified_at->ViewValue = $this->email_verified_at->CurrentValue;
		$this->email_verified_at->ViewValue = FormatDateTime($this->email_verified_at->ViewValue, 0);
		$this->email_verified_at->ViewCustomAttributes = "";

		// pwd
		$this->pwd->ViewValue = $this->pwd->CurrentValue;
		$this->pwd->ViewCustomAttributes = "";

		// package
		$curVal = strval($this->package->CurrentValue);
		if ($curVal != "") {
			$this->package->ViewValue = $this->package->lookupCacheOption($curVal);
			if ($this->package->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`package`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->package->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->package->ViewValue = $this->package->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->package->ViewValue = $this->package->CurrentValue;
				}
			}
		} else {
			$this->package->ViewValue = NULL;
		}
		$this->package->ViewCustomAttributes = "";

		// remember_token
		$this->remember_token->ViewValue = $this->remember_token->CurrentValue;
		$this->remember_token->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// updated_at
		$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
		$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
		$this->updated_at->ViewCustomAttributes = "";

		// role
		if (strval($this->role->CurrentValue) != "") {
			$this->role->ViewValue = $this->role->optionCaption($this->role->CurrentValue);
		} else {
			$this->role->ViewValue = NULL;
		}
		$this->role->ViewCustomAttributes = "";

		// token
		$this->_token->ViewValue = $this->_token->CurrentValue;
		$this->_token->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $this->password->CurrentValue;
		$this->password->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// name
		$this->name->LinkCustomAttributes = "";
		$this->name->HrefValue = "";
		$this->name->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// phone
		$this->phone->LinkCustomAttributes = "";
		$this->phone->HrefValue = "";
		$this->phone->TooltipValue = "";

		// email_verified_at
		$this->email_verified_at->LinkCustomAttributes = "";
		$this->email_verified_at->HrefValue = "";
		$this->email_verified_at->TooltipValue = "";

		// pwd
		$this->pwd->LinkCustomAttributes = "";
		$this->pwd->HrefValue = "";
		$this->pwd->TooltipValue = "";

		// package
		$this->package->LinkCustomAttributes = "";
		$this->package->HrefValue = "";
		$this->package->TooltipValue = "";

		// remember_token
		$this->remember_token->LinkCustomAttributes = "";
		$this->remember_token->HrefValue = "";
		$this->remember_token->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// updated_at
		$this->updated_at->LinkCustomAttributes = "";
		$this->updated_at->HrefValue = "";
		$this->updated_at->TooltipValue = "";

		// role
		$this->role->LinkCustomAttributes = "";
		$this->role->HrefValue = "";
		$this->role->TooltipValue = "";

		// token
		$this->_token->LinkCustomAttributes = "";
		$this->_token->HrefValue = "";
		$this->_token->TooltipValue = "";

		// password
		$this->password->LinkCustomAttributes = "";
		$this->password->HrefValue = "";
		$this->password->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// name
		$this->name->EditAttrs["class"] = "form-control";
		$this->name->EditCustomAttributes = "";
		if (!$this->name->Raw)
			$this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
		$this->name->EditValue = $this->name->CurrentValue;
		$this->name->PlaceHolder = RemoveHtml($this->name->caption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		if (!$this->_email->Raw)
			$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

		// phone
		$this->phone->EditAttrs["class"] = "form-control";
		$this->phone->EditCustomAttributes = "";
		if (!$this->phone->Raw)
			$this->phone->CurrentValue = HtmlDecode($this->phone->CurrentValue);
		$this->phone->EditValue = $this->phone->CurrentValue;
		$this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

		// email_verified_at
		$this->email_verified_at->EditAttrs["class"] = "form-control";
		$this->email_verified_at->EditCustomAttributes = "";
		$this->email_verified_at->EditValue = FormatDateTime($this->email_verified_at->CurrentValue, 8);
		$this->email_verified_at->PlaceHolder = RemoveHtml($this->email_verified_at->caption());

		// pwd
		$this->pwd->EditAttrs["class"] = "form-control";
		$this->pwd->EditCustomAttributes = "";
		if (!$this->pwd->Raw)
			$this->pwd->CurrentValue = HtmlDecode($this->pwd->CurrentValue);
		$this->pwd->EditValue = $this->pwd->CurrentValue;
		$this->pwd->PlaceHolder = RemoveHtml($this->pwd->caption());

		// package
		$this->package->EditCustomAttributes = "";

		// remember_token
		$this->remember_token->EditAttrs["class"] = "form-control";
		$this->remember_token->EditCustomAttributes = "";
		if (!$this->remember_token->Raw)
			$this->remember_token->CurrentValue = HtmlDecode($this->remember_token->CurrentValue);
		$this->remember_token->EditValue = $this->remember_token->CurrentValue;
		$this->remember_token->PlaceHolder = RemoveHtml($this->remember_token->caption());

		// created_at
		$this->created_at->EditAttrs["class"] = "form-control";
		$this->created_at->EditCustomAttributes = "";
		$this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, 8);
		$this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

		// updated_at
		$this->updated_at->EditAttrs["class"] = "form-control";
		$this->updated_at->EditCustomAttributes = "";
		$this->updated_at->EditValue = FormatDateTime($this->updated_at->CurrentValue, 8);
		$this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

		// role
		$this->role->EditCustomAttributes = "";
		$this->role->EditValue = $this->role->options(TRUE);

		// token
		$this->_token->EditAttrs["class"] = "form-control";
		$this->_token->EditCustomAttributes = "";
		if (!$this->_token->Raw)
			$this->_token->CurrentValue = HtmlDecode($this->_token->CurrentValue);
		$this->_token->EditValue = $this->_token->CurrentValue;
		$this->_token->PlaceHolder = RemoveHtml($this->_token->caption());

		// password
		$this->password->EditAttrs["class"] = "form-control";
		$this->password->EditCustomAttributes = "";
		if (!$this->password->Raw)
			$this->password->CurrentValue = HtmlDecode($this->password->CurrentValue);
		$this->password->EditValue = $this->password->CurrentValue;
		$this->password->PlaceHolder = RemoveHtml($this->password->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->name);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->phone);
					$doc->exportCaption($this->pwd);
					$doc->exportCaption($this->package);
					$doc->exportCaption($this->role);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->name);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->phone);
					$doc->exportCaption($this->pwd);
					$doc->exportCaption($this->package);
					$doc->exportCaption($this->role);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id);
						$doc->exportField($this->name);
						$doc->exportField($this->_email);
						$doc->exportField($this->phone);
						$doc->exportField($this->pwd);
						$doc->exportField($this->package);
						$doc->exportField($this->role);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->name);
						$doc->exportField($this->_email);
						$doc->exportField($this->phone);
						$doc->exportField($this->pwd);
						$doc->exportField($this->package);
						$doc->exportField($this->role);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE
			//echo "Row Inserted"

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		include "../dbconfig.php";

		//$salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
		//$hash = crypt($rsnew["pwd"], 'y$' . $salt);
		//$enc =  password_hash($rsnew["pwd"]);

		$hash =password_hash($rsnew["pwd"], PASSWORD_BCRYPT, [10]);
		$sql="UPDATE users set password='".$hash ."' WHERE id=".$rsnew["id"];
		$res= mysqli_query($conn,$sql);
	$sql="SELECT count(`id`) FROM `accounts` WHERE `user_id`=".$rsnew["id"];
	$res= mysqli_query($conn,$sql);
	$cc=0;
	if($rr=$res->fetch_row())
		 {
		 $cc=intval($rr[0]);
		 }
		if($rsnew["package"]!="")
		{
		$sql="SELECT `number_of_words`,`period_in_months`,`connection_points` FROM `packags` WHERE `package`='".$rsnew["package"]."'";
		$res= mysqli_query($conn,$sql);
		$nw="";
		$prd="";
		$cp="";
		if($rr=$res->fetch_row())
		 {
		 $nw=$rr[0];
		 $prd=$rr[1];
		 $cp=$rr[2];
		 $exp= date('Y-m-d', strtotime("+$prd months"));
		 $sqll="INSERT INTO `accounts`(`user_id`, `name`, `email`, `phone`, `package`, `words`,  `connection_points`,`remain_words`,`expire_date`) VALUES(";
		 $sq=$rsnew["id"].",'".$rsnew["name"]."','".$rsnew["email"]."','".$rsnew["phone"]."','".$rsnew["package"]."',".$nw.",".$cp.",".$nw.",'".$exp."')";
		 $sqll=$sqll.$sq;
		 if($cc<1) $result=mysqli_query($conn,$sqll);
		 }
		}
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
			//echo "Row Inserted"

		include "../dbconfig.php";

		//$salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
		//$hash = crypt($rsnew["pwd"], 'y$' . $salt);
		//$enc =  password_hash($rsnew["pwd"]);

		$hash =password_hash($rsnew["pwd"], PASSWORD_BCRYPT, [10]);
		$sql="UPDATE users set password='".$hash ."' WHERE id=".$rsnew["id"];
		$res= mysqli_query($conn,$sql);
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>