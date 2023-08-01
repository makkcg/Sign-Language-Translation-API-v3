<?php
namespace PHPMaker2020\signwords;

/**
 * Page class
 */
class accounts_add extends accounts
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{CCDF4E7E-11C4-4BCB-AC19-8C4385A0838C}";

	// Table name
	public $TableName = 'accounts';

	// Page object name
	public $PageObjName = "accounts_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (accounts)
		if (!isset($GLOBALS["accounts"]) || get_class($GLOBALS["accounts"]) == PROJECT_NAMESPACE . "accounts") {
			$GLOBALS["accounts"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["accounts"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'accounts');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $accounts;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($accounts);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "accountsview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			return TRUE;
		}
		return FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->user_id->setVisibility();
		$this->name->setVisibility();
		$this->_email->setVisibility();
		$this->phone->setVisibility();
		$this->words->setVisibility();
		$this->used_words->setVisibility();
		$this->remain_words->setVisibility();
		$this->connection_points->setVisibility();
		$this->created_at->Visible = FALSE;
		$this->updated_at->Visible = FALSE;
		$this->package->setVisibility();
		$this->expire_date->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->package);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("accountslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "accountslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "accountsview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->name->CurrentValue = NULL;
		$this->name->OldValue = $this->name->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->phone->CurrentValue = NULL;
		$this->phone->OldValue = $this->phone->CurrentValue;
		$this->words->CurrentValue = 0;
		$this->used_words->CurrentValue = 0;
		$this->remain_words->CurrentValue = 0;
		$this->connection_points->CurrentValue = 0;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
		$this->package->CurrentValue = NULL;
		$this->package->OldValue = $this->package->CurrentValue;
		$this->expire_date->CurrentValue = NULL;
		$this->expire_date->OldValue = $this->expire_date->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'user_id' first before field var 'x_user_id'
		$val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
		if (!$this->user_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_id->Visible = FALSE; // Disable update for API request
			else
				$this->user_id->setFormValue($val);
		}

		// Check field name 'name' first before field var 'x_name'
		$val = $CurrentForm->hasValue("name") ? $CurrentForm->getValue("name") : $CurrentForm->getValue("x_name");
		if (!$this->name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->name->Visible = FALSE; // Disable update for API request
			else
				$this->name->setFormValue($val);
		}

		// Check field name 'email' first before field var 'x__email'
		$val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
		if (!$this->_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_email->Visible = FALSE; // Disable update for API request
			else
				$this->_email->setFormValue($val);
		}

		// Check field name 'phone' first before field var 'x_phone'
		$val = $CurrentForm->hasValue("phone") ? $CurrentForm->getValue("phone") : $CurrentForm->getValue("x_phone");
		if (!$this->phone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->phone->Visible = FALSE; // Disable update for API request
			else
				$this->phone->setFormValue($val);
		}

		// Check field name 'words' first before field var 'x_words'
		$val = $CurrentForm->hasValue("words") ? $CurrentForm->getValue("words") : $CurrentForm->getValue("x_words");
		if (!$this->words->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->words->Visible = FALSE; // Disable update for API request
			else
				$this->words->setFormValue($val);
		}

		// Check field name 'used_words' first before field var 'x_used_words'
		$val = $CurrentForm->hasValue("used_words") ? $CurrentForm->getValue("used_words") : $CurrentForm->getValue("x_used_words");
		if (!$this->used_words->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->used_words->Visible = FALSE; // Disable update for API request
			else
				$this->used_words->setFormValue($val);
		}

		// Check field name 'remain_words' first before field var 'x_remain_words'
		$val = $CurrentForm->hasValue("remain_words") ? $CurrentForm->getValue("remain_words") : $CurrentForm->getValue("x_remain_words");
		if (!$this->remain_words->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->remain_words->Visible = FALSE; // Disable update for API request
			else
				$this->remain_words->setFormValue($val);
		}

		// Check field name 'connection_points' first before field var 'x_connection_points'
		$val = $CurrentForm->hasValue("connection_points") ? $CurrentForm->getValue("connection_points") : $CurrentForm->getValue("x_connection_points");
		if (!$this->connection_points->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->connection_points->Visible = FALSE; // Disable update for API request
			else
				$this->connection_points->setFormValue($val);
		}

		// Check field name 'package' first before field var 'x_package'
		$val = $CurrentForm->hasValue("package") ? $CurrentForm->getValue("package") : $CurrentForm->getValue("x_package");
		if (!$this->package->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->package->Visible = FALSE; // Disable update for API request
			else
				$this->package->setFormValue($val);
		}

		// Check field name 'expire_date' first before field var 'x_expire_date'
		$val = $CurrentForm->hasValue("expire_date") ? $CurrentForm->getValue("expire_date") : $CurrentForm->getValue("x_expire_date");
		if (!$this->expire_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->expire_date->Visible = FALSE; // Disable update for API request
			else
				$this->expire_date->setFormValue($val);
			$this->expire_date->CurrentValue = UnFormatDateTime($this->expire_date->CurrentValue, 0);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->name->CurrentValue = $this->name->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->words->CurrentValue = $this->words->FormValue;
		$this->used_words->CurrentValue = $this->used_words->FormValue;
		$this->remain_words->CurrentValue = $this->remain_words->FormValue;
		$this->connection_points->CurrentValue = $this->connection_points->FormValue;
		$this->package->CurrentValue = $this->package->FormValue;
		$this->expire_date->CurrentValue = $this->expire_date->FormValue;
		$this->expire_date->CurrentValue = UnFormatDateTime($this->expire_date->CurrentValue, 0);
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->user_id->setDbValue($row['user_id']);
		$this->name->setDbValue($row['name']);
		$this->_email->setDbValue($row['email']);
		$this->phone->setDbValue($row['phone']);
		$this->words->setDbValue($row['words']);
		$this->used_words->setDbValue($row['used_words']);
		$this->remain_words->setDbValue($row['remain_words']);
		$this->connection_points->setDbValue($row['connection_points']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->package->setDbValue($row['package']);
		$this->expire_date->setDbValue($row['expire_date']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['name'] = $this->name->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['phone'] = $this->phone->CurrentValue;
		$row['words'] = $this->words->CurrentValue;
		$row['used_words'] = $this->used_words->CurrentValue;
		$row['remain_words'] = $this->remain_words->CurrentValue;
		$row['connection_points'] = $this->connection_points->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
		$row['package'] = $this->package->CurrentValue;
		$row['expire_date'] = $this->expire_date->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// user_id
		// name
		// email
		// phone
		// words
		// used_words
		// remain_words
		// connection_points
		// created_at
		// updated_at
		// package
		// expire_date

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// user_id
			$this->user_id->ViewValue = $this->user_id->CurrentValue;
			$this->user_id->ViewValue = FormatNumber($this->user_id->ViewValue, 0, -2, -2, -2);
			$this->user_id->ViewCustomAttributes = "";

			// name
			$this->name->ViewValue = $this->name->CurrentValue;
			$this->name->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// phone
			$this->phone->ViewValue = $this->phone->CurrentValue;
			$this->phone->ViewCustomAttributes = "";

			// words
			$this->words->ViewValue = $this->words->CurrentValue;
			$this->words->ViewValue = FormatNumber($this->words->ViewValue, 0, -2, -2, -2);
			$this->words->ViewCustomAttributes = "";

			// used_words
			$this->used_words->ViewValue = $this->used_words->CurrentValue;
			$this->used_words->ViewValue = FormatNumber($this->used_words->ViewValue, 0, -2, -2, -2);
			$this->used_words->ViewCustomAttributes = "";

			// remain_words
			$this->remain_words->ViewValue = $this->remain_words->CurrentValue;
			$this->remain_words->ViewValue = FormatNumber($this->remain_words->ViewValue, 0, -2, -2, -2);
			$this->remain_words->ViewCustomAttributes = "";

			// connection_points
			$this->connection_points->ViewValue = $this->connection_points->CurrentValue;
			$this->connection_points->ViewValue = FormatNumber($this->connection_points->ViewValue, 0, -2, -2, -2);
			$this->connection_points->ViewCustomAttributes = "";

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

			// expire_date
			$this->expire_date->ViewValue = $this->expire_date->CurrentValue;
			$this->expire_date->ViewValue = FormatDateTime($this->expire_date->ViewValue, 0);
			$this->expire_date->ViewCustomAttributes = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

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

			// words
			$this->words->LinkCustomAttributes = "";
			$this->words->HrefValue = "";
			$this->words->TooltipValue = "";

			// used_words
			$this->used_words->LinkCustomAttributes = "";
			$this->used_words->HrefValue = "";
			$this->used_words->TooltipValue = "";

			// remain_words
			$this->remain_words->LinkCustomAttributes = "";
			$this->remain_words->HrefValue = "";
			$this->remain_words->TooltipValue = "";

			// connection_points
			$this->connection_points->LinkCustomAttributes = "";
			$this->connection_points->HrefValue = "";
			$this->connection_points->TooltipValue = "";

			// package
			$this->package->LinkCustomAttributes = "";
			$this->package->HrefValue = "";
			$this->package->TooltipValue = "";

			// expire_date
			$this->expire_date->LinkCustomAttributes = "";
			$this->expire_date->HrefValue = "";
			$this->expire_date->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
			$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());

			// name
			$this->name->EditAttrs["class"] = "form-control";
			$this->name->EditCustomAttributes = "";
			if (!$this->name->Raw)
				$this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
			$this->name->EditValue = HtmlEncode($this->name->CurrentValue);
			$this->name->PlaceHolder = RemoveHtml($this->name->caption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			if (!$this->_email->Raw)
				$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
			$this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			if (!$this->phone->Raw)
				$this->phone->CurrentValue = HtmlDecode($this->phone->CurrentValue);
			$this->phone->EditValue = HtmlEncode($this->phone->CurrentValue);
			$this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

			// words
			$this->words->EditAttrs["class"] = "form-control";
			$this->words->EditCustomAttributes = "";
			$this->words->EditValue = HtmlEncode($this->words->CurrentValue);
			$this->words->PlaceHolder = RemoveHtml($this->words->caption());

			// used_words
			$this->used_words->EditAttrs["class"] = "form-control";
			$this->used_words->EditCustomAttributes = "";
			$this->used_words->EditValue = HtmlEncode($this->used_words->CurrentValue);
			$this->used_words->PlaceHolder = RemoveHtml($this->used_words->caption());

			// remain_words
			$this->remain_words->EditAttrs["class"] = "form-control";
			$this->remain_words->EditCustomAttributes = "";
			$this->remain_words->EditValue = HtmlEncode($this->remain_words->CurrentValue);
			$this->remain_words->PlaceHolder = RemoveHtml($this->remain_words->caption());

			// connection_points
			$this->connection_points->EditAttrs["class"] = "form-control";
			$this->connection_points->EditCustomAttributes = "";
			$this->connection_points->EditValue = HtmlEncode($this->connection_points->CurrentValue);
			$this->connection_points->PlaceHolder = RemoveHtml($this->connection_points->caption());

			// package
			$this->package->EditCustomAttributes = "";
			$curVal = trim(strval($this->package->CurrentValue));
			if ($curVal != "")
				$this->package->ViewValue = $this->package->lookupCacheOption($curVal);
			else
				$this->package->ViewValue = $this->package->Lookup !== NULL && is_array($this->package->Lookup->Options) ? $curVal : NULL;
			if ($this->package->ViewValue !== NULL) { // Load from cache
				$this->package->EditValue = array_values($this->package->Lookup->Options);
				if ($this->package->ViewValue == "")
					$this->package->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`package`" . SearchString("=", $this->package->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->package->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->package->ViewValue = $this->package->displayValue($arwrk);
				} else {
					$this->package->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->package->EditValue = $arwrk;
			}

			// expire_date
			$this->expire_date->EditAttrs["class"] = "form-control";
			$this->expire_date->EditCustomAttributes = "";
			$this->expire_date->EditValue = HtmlEncode(FormatDateTime($this->expire_date->CurrentValue, 8));
			$this->expire_date->PlaceHolder = RemoveHtml($this->expire_date->caption());

			// Add refer script
			// user_id

			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// words
			$this->words->LinkCustomAttributes = "";
			$this->words->HrefValue = "";

			// used_words
			$this->used_words->LinkCustomAttributes = "";
			$this->used_words->HrefValue = "";

			// remain_words
			$this->remain_words->LinkCustomAttributes = "";
			$this->remain_words->HrefValue = "";

			// connection_points
			$this->connection_points->LinkCustomAttributes = "";
			$this->connection_points->HrefValue = "";

			// package
			$this->package->LinkCustomAttributes = "";
			$this->package->HrefValue = "";

			// expire_date
			$this->expire_date->LinkCustomAttributes = "";
			$this->expire_date->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->user_id->Required) {
			if (!$this->user_id->IsDetailKey && $this->user_id->FormValue != NULL && $this->user_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_id->caption(), $this->user_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->user_id->FormValue)) {
			AddMessage($FormError, $this->user_id->errorMessage());
		}
		if ($this->name->Required) {
			if (!$this->name->IsDetailKey && $this->name->FormValue != NULL && $this->name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->name->caption(), $this->name->RequiredErrorMessage));
			}
		}
		if ($this->_email->Required) {
			if (!$this->_email->IsDetailKey && $this->_email->FormValue != NULL && $this->_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
			}
		}
		if ($this->phone->Required) {
			if (!$this->phone->IsDetailKey && $this->phone->FormValue != NULL && $this->phone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->phone->caption(), $this->phone->RequiredErrorMessage));
			}
		}
		if ($this->words->Required) {
			if (!$this->words->IsDetailKey && $this->words->FormValue != NULL && $this->words->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->words->caption(), $this->words->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->words->FormValue)) {
			AddMessage($FormError, $this->words->errorMessage());
		}
		if ($this->used_words->Required) {
			if (!$this->used_words->IsDetailKey && $this->used_words->FormValue != NULL && $this->used_words->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->used_words->caption(), $this->used_words->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->used_words->FormValue)) {
			AddMessage($FormError, $this->used_words->errorMessage());
		}
		if ($this->remain_words->Required) {
			if (!$this->remain_words->IsDetailKey && $this->remain_words->FormValue != NULL && $this->remain_words->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->remain_words->caption(), $this->remain_words->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->remain_words->FormValue)) {
			AddMessage($FormError, $this->remain_words->errorMessage());
		}
		if ($this->connection_points->Required) {
			if (!$this->connection_points->IsDetailKey && $this->connection_points->FormValue != NULL && $this->connection_points->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->connection_points->caption(), $this->connection_points->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->connection_points->FormValue)) {
			AddMessage($FormError, $this->connection_points->errorMessage());
		}
		if ($this->package->Required) {
			if (!$this->package->IsDetailKey && $this->package->FormValue != NULL && $this->package->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->package->caption(), $this->package->RequiredErrorMessage));
			}
		}
		if ($this->expire_date->Required) {
			if (!$this->expire_date->IsDetailKey && $this->expire_date->FormValue != NULL && $this->expire_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->expire_date->caption(), $this->expire_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->expire_date->FormValue)) {
			AddMessage($FormError, $this->expire_date->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// user_id
		$this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, 0, FALSE);

		// name
		$this->name->setDbValueDef($rsnew, $this->name->CurrentValue, NULL, FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// phone
		$this->phone->setDbValueDef($rsnew, $this->phone->CurrentValue, NULL, FALSE);

		// words
		$this->words->setDbValueDef($rsnew, $this->words->CurrentValue, 0, strval($this->words->CurrentValue) == "");

		// used_words
		$this->used_words->setDbValueDef($rsnew, $this->used_words->CurrentValue, 0, strval($this->used_words->CurrentValue) == "");

		// remain_words
		$this->remain_words->setDbValueDef($rsnew, $this->remain_words->CurrentValue, 0, strval($this->remain_words->CurrentValue) == "");

		// connection_points
		$this->connection_points->setDbValueDef($rsnew, $this->connection_points->CurrentValue, 0, strval($this->connection_points->CurrentValue) == "");

		// package
		$this->package->setDbValueDef($rsnew, $this->package->CurrentValue, NULL, FALSE);

		// expire_date
		$this->expire_date->setDbValueDef($rsnew, UnFormatDateTime($this->expire_date->CurrentValue, 0), NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("accountslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_package":
					$conn = Conn("");
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_package":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>