<?php

namespace PHPMaker2024\tagihanwifi01;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;
use Closure;

/**
 * Page class
 */
class DataPelangganEdit extends DataPelanggan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "DataPelangganEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "DataPelangganEdit";

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<div id="ew-page-header">' . $header . '</div>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<div id="ew-page-footer">' . $footer . '</div>';
        }
    }

    // Set field visibility
    public function setVisibility()
    {
        $this->NomorPelanggan->setVisibility();
        $this->NamaPelanggan->setVisibility();
        $this->IP->setVisibility();
        $this->Bandwidth->setVisibility();
        $this->Harga->setVisibility();
        $this->JenisSubscription->setVisibility();
        $this->BulanSubscription->setVisibility();
        $this->KeteranganSubscription->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer;
        $this->TableVar = 'data_pelanggan';
        $this->TableName = 'data_pelanggan';

        // Table CSS class
        $this->TableClass = "table table-striped table-borderless table-hover ew-desktop-table ew-edit-table d-none";

        // Custom template
        $this->UseCustomTemplate = true;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("app.language");

        // Table object (data_pelanggan)
        if (!isset($GLOBALS["data_pelanggan"]) || $GLOBALS["data_pelanggan"]::class == PROJECT_NAMESPACE . "data_pelanggan") {
            $GLOBALS["data_pelanggan"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'data_pelanggan');
        }

        // Start timer
        $DebugTimer = Container("debug.timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return $Response?->getBody() ?? ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }
        DispatchEvent(new PageUnloadedEvent($this), PageUnloadedEvent::NAME);
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (WithJsonResponse()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $pageName = GetPageName($url);
                $result = ["url" => GetUrl($url), "modal" => "1"];  // Assume return to modal for simplicity
                if (
                    SameString($pageName, GetPageName($this->getListUrl())) ||
                    SameString($pageName, GetPageName($this->getViewUrl())) ||
                    SameString($pageName, GetPageName(CurrentMasterTable()?->getViewUrl() ?? ""))
                ) { // List / View / Master View page
                    if (!SameString($pageName, GetPageName($this->getListUrl()))) { // Not List page
                        $result["caption"] = $this->getModalCaption($pageName);
                        $result["view"] = SameString($pageName, "DataPelangganView"); // If View page, no primary button
                    } else { // List page
                        $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                        $this->clearFailureMessage();
                    }
                } else { // Other pages (add messages and then clear messages)
                    $result = array_merge($this->getMessages(), ["modal" => "1"]);
                    $this->clearMessages();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from result set
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Result set
            while ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($row);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
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
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DataType::BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
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
            $key .= @$ar['NomorPelanggan'];
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
    }

    // Lookup data
    public function lookup(array $req = [], bool $response = true)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $req["field"] ?? null;
        if (!$fieldName) {
            return [];
        }
        $fld = $this->Fields[$fieldName];
        $lookup = $fld->Lookup;
        $name = $req["name"] ?? "";
        if (ContainsString($name, "query_builder_rule")) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $req["ajax"] ?? "unknown";
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $req["q"] ?? $req["sv"] ?? "";
            $pageSize = $req["n"] ?? $req["recperpage"] ?? 10;
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $req["q"] ?? "";
            $pageSize = $req["n"] ?? -1;
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $req["start"] ?? -1;
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $req["page"] ?? -1;
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($req["s"] ?? "");
        $userFilter = Decrypt($req["f"] ?? "");
        $userOrderBy = Decrypt($req["o"] ?? "");
        $keys = $req["keys"] ?? null;
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $req["v0"] ?? $req["lookupValue"] ?? "";
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $req["v" . $i] ?? "";
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, $response); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Load user profile
        if (IsLoggedIn()) {
            Profile()->setUserName(CurrentUserName())->loadFromStorage();
        }

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->setVisibility();
        $this->NomorPelanggan->Required = false;

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        DispatchEvent(new PageLoadingEvent($this), PageLoadingEvent::NAME);

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->Bandwidth);
        $this->setupLookupOptions($this->JenisSubscription);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;

        // Load record by position
        $loadByPosition = false;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("NomorPelanggan") ?? Key(0) ?? Route(2)) !== null) {
                $this->NomorPelanggan->setQueryStringValue($keyValue);
                $this->NomorPelanggan->setOldValue($this->NomorPelanggan->QueryStringValue);
            } elseif (Post("NomorPelanggan") !== null) {
                $this->NomorPelanggan->setFormValue(Post("NomorPelanggan"));
                $this->NomorPelanggan->setOldValue($this->NomorPelanggan->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action", "") !== "") {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("NomorPelanggan") ?? Route("NomorPelanggan")) !== null) {
                    $this->NomorPelanggan->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->NomorPelanggan->CurrentValue = null;
                }
                if (!$loadByQuery || Get(Config("TABLE_START_REC")) !== null || Get(Config("TABLE_PAGE_NUMBER")) !== null) {
                    $loadByPosition = true;
                }
            }

            // Load result set
            if ($this->isShow()) {
                if (!$this->IsModal) { // Normal edit page
                    $this->StartRecord = 1; // Initialize start position
                    $this->Recordset = $this->loadRecordset(); // Load records
                    if ($this->TotalRecords <= 0) { // No record found
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $this->terminate("DataPelangganList"); // Return to list page
                        return;
                    } elseif ($loadByPosition) { // Load record by position
                        $this->setupStartRecord(); // Set up start record position
                        // Point to current record
                        if ($this->StartRecord <= $this->TotalRecords) {
                            $this->fetch($this->StartRecord);
                            // Redirect to correct record
                            $this->loadRowValues($this->CurrentRow);
                            $url = $this->getCurrentUrl();
                            $this->terminate($url);
                            return;
                        }
                    } else { // Match key values
                        if ($this->NomorPelanggan->CurrentValue != null) {
                            while ($this->fetch()) {
                                if (SameString($this->NomorPelanggan->CurrentValue, $this->CurrentRow['NomorPelanggan'])) {
                                    $this->setStartRecordNumber($this->StartRecord); // Save record position
                                    $loaded = true;
                                    break;
                                } else {
                                    $this->StartRecord++;
                                }
                            }
                        }
                    }

                    // Load current row values
                    if ($loaded) {
                        $this->loadRowValues($this->CurrentRow);
                    }
                } else {
                    // Load current record
                    $loaded = $this->loadRow();
                } // End modal checking
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$this->IsModal) { // Normal edit page
                    if (!$loaded) {
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $this->terminate("DataPelangganList"); // Return to list page
                        return;
                    } else {
                    }
                } else { // Modal edit page
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("DataPelangganList"); // No matching record, return to list
                        return;
                    }
                } // End modal checking
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "DataPelangganList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }

                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "DataPelangganList") {
                            Container("app.flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "DataPelangganList"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson(["success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage()]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = RowType::EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();
        if (!$this->IsModal) { // Normal view page
            $this->Pager = new PrevNextPager($this, $this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager, false, false);
            $this->Pager->PageNumberName = Config("TABLE_PAGE_NUMBER");
            $this->Pager->PagePhraseId = "Record"; // Show as record
        }

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            DispatchEvent(new PageRenderingEvent($this), PageRenderingEvent::NAME);

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'NomorPelanggan' first before field var 'x_NomorPelanggan'
        $val = $CurrentForm->hasValue("NomorPelanggan") ? $CurrentForm->getValue("NomorPelanggan") : $CurrentForm->getValue("x_NomorPelanggan");
        if (!$this->NomorPelanggan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NomorPelanggan->Visible = false; // Disable update for API request
            } else {
                $this->NomorPelanggan->setFormValue($val);
            }
        }

        // Check field name 'NamaPelanggan' first before field var 'x_NamaPelanggan'
        $val = $CurrentForm->hasValue("NamaPelanggan") ? $CurrentForm->getValue("NamaPelanggan") : $CurrentForm->getValue("x_NamaPelanggan");
        if (!$this->NamaPelanggan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NamaPelanggan->Visible = false; // Disable update for API request
            } else {
                $this->NamaPelanggan->setFormValue($val);
            }
        }

        // Check field name 'IP' first before field var 'x_IP'
        $val = $CurrentForm->hasValue("IP") ? $CurrentForm->getValue("IP") : $CurrentForm->getValue("x_IP");
        if (!$this->IP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->IP->Visible = false; // Disable update for API request
            } else {
                $this->IP->setFormValue($val);
            }
        }

        // Check field name 'Bandwidth' first before field var 'x_Bandwidth'
        $val = $CurrentForm->hasValue("Bandwidth") ? $CurrentForm->getValue("Bandwidth") : $CurrentForm->getValue("x_Bandwidth");
        if (!$this->Bandwidth->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Bandwidth->Visible = false; // Disable update for API request
            } else {
                $this->Bandwidth->setFormValue($val);
            }
        }

        // Check field name 'Harga' first before field var 'x_Harga'
        $val = $CurrentForm->hasValue("Harga") ? $CurrentForm->getValue("Harga") : $CurrentForm->getValue("x_Harga");
        if (!$this->Harga->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Harga->Visible = false; // Disable update for API request
            } else {
                $this->Harga->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'JenisSubscription' first before field var 'x_JenisSubscription'
        $val = $CurrentForm->hasValue("JenisSubscription") ? $CurrentForm->getValue("JenisSubscription") : $CurrentForm->getValue("x_JenisSubscription");
        if (!$this->JenisSubscription->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->JenisSubscription->Visible = false; // Disable update for API request
            } else {
                $this->JenisSubscription->setFormValue($val);
            }
        }

        // Check field name 'BulanSubscription' first before field var 'x_BulanSubscription'
        $val = $CurrentForm->hasValue("BulanSubscription") ? $CurrentForm->getValue("BulanSubscription") : $CurrentForm->getValue("x_BulanSubscription");
        if (!$this->BulanSubscription->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->BulanSubscription->Visible = false; // Disable update for API request
            } else {
                $this->BulanSubscription->setFormValue($val);
            }
        }

        // Check field name 'KeteranganSubscription' first before field var 'x_KeteranganSubscription'
        $val = $CurrentForm->hasValue("KeteranganSubscription") ? $CurrentForm->getValue("KeteranganSubscription") : $CurrentForm->getValue("x_KeteranganSubscription");
        if (!$this->KeteranganSubscription->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KeteranganSubscription->Visible = false; // Disable update for API request
            } else {
                $this->KeteranganSubscription->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NomorPelanggan->CurrentValue = $this->NomorPelanggan->FormValue;
        $this->NamaPelanggan->CurrentValue = $this->NamaPelanggan->FormValue;
        $this->IP->CurrentValue = $this->IP->FormValue;
        $this->Bandwidth->CurrentValue = $this->Bandwidth->FormValue;
        $this->Harga->CurrentValue = $this->Harga->FormValue;
        $this->JenisSubscription->CurrentValue = $this->JenisSubscription->FormValue;
        $this->BulanSubscription->CurrentValue = $this->BulanSubscription->FormValue;
        $this->KeteranganSubscription->CurrentValue = $this->KeteranganSubscription->FormValue;
    }

    /**
     * Load result set
     *
     * @param int $offset Offset
     * @param int $rowcnt Maximum number of rows
     * @return Doctrine\DBAL\Result Result
     */
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load result set
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->executeQuery();
        if (property_exists($this, "TotalRecords") && $rowcnt < 0) {
            $this->TotalRecords = $result->rowCount();
            if ($this->TotalRecords <= 0) { // Handle database drivers that does not return rowCount()
                $this->TotalRecords = $this->getRecordCount($this->getListSql());
            }
        }

        // Call Recordset Selected event
        $this->recordsetSelected($result);
        return $result;
    }

    /**
     * Load records as associative array
     *
     * @param int $offset Offset
     * @param int $rowcnt Maximum number of rows
     * @return void
     */
    public function loadRows($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load result set
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->executeQuery();
        return $result->fetchAllAssociative();
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from result set or record
     *
     * @param array $row Record
     * @return void
     */
    public function loadRowValues($row = null)
    {
        $row = is_array($row) ? $row : $this->newRow();

        // Call Row Selected event
        $this->rowSelected($row);
        $this->NomorPelanggan->setDbValue($row['NomorPelanggan']);
        $this->NamaPelanggan->setDbValue($row['NamaPelanggan']);
        $this->IP->setDbValue($row['IP']);
        $this->Bandwidth->setDbValue($row['Bandwidth']);
        $this->Harga->setDbValue($row['Harga']);
        $this->JenisSubscription->setDbValue($row['JenisSubscription']);
        $this->BulanSubscription->setDbValue($row['BulanSubscription']);
        $this->KeteranganSubscription->setDbValue($row['KeteranganSubscription']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NomorPelanggan'] = $this->NomorPelanggan->DefaultValue;
        $row['NamaPelanggan'] = $this->NamaPelanggan->DefaultValue;
        $row['IP'] = $this->IP->DefaultValue;
        $row['Bandwidth'] = $this->Bandwidth->DefaultValue;
        $row['Harga'] = $this->Harga->DefaultValue;
        $row['JenisSubscription'] = $this->JenisSubscription->DefaultValue;
        $row['BulanSubscription'] = $this->BulanSubscription->DefaultValue;
        $row['KeteranganSubscription'] = $this->KeteranganSubscription->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = ExecuteQuery($sql, $conn);
            if ($row = $rs->fetch()) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NomorPelanggan
        $this->NomorPelanggan->RowCssClass = "row";

        // NamaPelanggan
        $this->NamaPelanggan->RowCssClass = "row";

        // IP
        $this->IP->RowCssClass = "row";

        // Bandwidth
        $this->Bandwidth->RowCssClass = "row";

        // Harga
        $this->Harga->RowCssClass = "row";

        // JenisSubscription
        $this->JenisSubscription->RowCssClass = "row";

        // BulanSubscription
        $this->BulanSubscription->RowCssClass = "row";

        // KeteranganSubscription
        $this->KeteranganSubscription->RowCssClass = "row";

        // View row
        if ($this->RowType == RowType::VIEW) {
            // NomorPelanggan
            $this->NomorPelanggan->ViewValue = $this->NomorPelanggan->CurrentValue;

            // NamaPelanggan
            $this->NamaPelanggan->ViewValue = $this->NamaPelanggan->CurrentValue;

            // IP
            $this->IP->ViewValue = $this->IP->CurrentValue;

            // Bandwidth
            $curVal = strval($this->Bandwidth->CurrentValue);
            if ($curVal != "") {
                $this->Bandwidth->ViewValue = $this->Bandwidth->lookupCacheOption($curVal);
                if ($this->Bandwidth->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->Bandwidth->Lookup->getTable()->Fields["Bandwidth"]->searchExpression(), "=", $curVal, $this->Bandwidth->Lookup->getTable()->Fields["Bandwidth"]->searchDataType(), "");
                    $sqlWrk = $this->Bandwidth->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Bandwidth->Lookup->renderViewRow($rswrk[0]);
                        $this->Bandwidth->ViewValue = $this->Bandwidth->displayValue($arwrk);
                    } else {
                        $this->Bandwidth->ViewValue = $this->Bandwidth->CurrentValue;
                    }
                }
            } else {
                $this->Bandwidth->ViewValue = null;
            }

            // Harga
            $this->Harga->ViewValue = $this->Harga->CurrentValue;
            $this->Harga->ViewValue = FormatCurrency($this->Harga->ViewValue, $this->Harga->formatPattern());

            // JenisSubscription
            $curVal = strval($this->JenisSubscription->CurrentValue);
            if ($curVal != "") {
                $this->JenisSubscription->ViewValue = $this->JenisSubscription->lookupCacheOption($curVal);
                if ($this->JenisSubscription->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter($this->JenisSubscription->Lookup->getTable()->Fields["JenisSubscription"]->searchExpression(), "=", $curVal, $this->JenisSubscription->Lookup->getTable()->Fields["JenisSubscription"]->searchDataType(), "");
                    $sqlWrk = $this->JenisSubscription->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCache($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->JenisSubscription->Lookup->renderViewRow($rswrk[0]);
                        $this->JenisSubscription->ViewValue = $this->JenisSubscription->displayValue($arwrk);
                    } else {
                        $this->JenisSubscription->ViewValue = $this->JenisSubscription->CurrentValue;
                    }
                }
            } else {
                $this->JenisSubscription->ViewValue = null;
            }

            // BulanSubscription
            $this->BulanSubscription->ViewValue = $this->BulanSubscription->CurrentValue;

            // KeteranganSubscription
            $this->KeteranganSubscription->ViewValue = $this->KeteranganSubscription->CurrentValue;

            // NomorPelanggan
            $this->NomorPelanggan->HrefValue = "";
            $this->NomorPelanggan->TooltipValue = "";

            // NamaPelanggan
            $this->NamaPelanggan->HrefValue = "";

            // IP
            $this->IP->HrefValue = "";

            // Bandwidth
            $this->Bandwidth->HrefValue = "";

            // Harga
            $this->Harga->HrefValue = "";

            // JenisSubscription
            $this->JenisSubscription->HrefValue = "";

            // BulanSubscription
            $this->BulanSubscription->HrefValue = "";

            // KeteranganSubscription
            $this->KeteranganSubscription->HrefValue = "";
        } elseif ($this->RowType == RowType::EDIT) {
            // NomorPelanggan
            $this->NomorPelanggan->setupEditAttributes();
            $this->NomorPelanggan->EditValue = $this->NomorPelanggan->CurrentValue;

            // NamaPelanggan
            $this->NamaPelanggan->setupEditAttributes();
            if (!$this->NamaPelanggan->Raw) {
                $this->NamaPelanggan->CurrentValue = HtmlDecode($this->NamaPelanggan->CurrentValue);
            }
            $this->NamaPelanggan->EditValue = HtmlEncode($this->NamaPelanggan->CurrentValue);
            $this->NamaPelanggan->PlaceHolder = RemoveHtml($this->NamaPelanggan->caption());

            // IP
            $this->IP->setupEditAttributes();
            if (!$this->IP->Raw) {
                $this->IP->CurrentValue = HtmlDecode($this->IP->CurrentValue);
            }
            $this->IP->EditValue = HtmlEncode($this->IP->CurrentValue);
            $this->IP->PlaceHolder = RemoveHtml($this->IP->caption());

            // Bandwidth
            $curVal = trim(strval($this->Bandwidth->CurrentValue));
            if ($curVal != "") {
                $this->Bandwidth->ViewValue = $this->Bandwidth->lookupCacheOption($curVal);
            } else {
                $this->Bandwidth->ViewValue = $this->Bandwidth->Lookup !== null && is_array($this->Bandwidth->lookupOptions()) && count($this->Bandwidth->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->Bandwidth->ViewValue !== null) { // Load from cache
                $this->Bandwidth->EditValue = array_values($this->Bandwidth->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->Bandwidth->Lookup->getTable()->Fields["Bandwidth"]->searchExpression(), "=", $this->Bandwidth->CurrentValue, $this->Bandwidth->Lookup->getTable()->Fields["Bandwidth"]->searchDataType(), "");
                }
                $sqlWrk = $this->Bandwidth->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Bandwidth->EditValue = $arwrk;
            }
            $this->Bandwidth->PlaceHolder = RemoveHtml($this->Bandwidth->caption());

            // Harga
            $this->Harga->setupEditAttributes();
            $this->Harga->EditValue = $this->Harga->CurrentValue;
            $this->Harga->PlaceHolder = RemoveHtml($this->Harga->caption());
            if (strval($this->Harga->EditValue) != "" && is_numeric($this->Harga->EditValue)) {
                $this->Harga->EditValue = FormatNumber($this->Harga->EditValue, null);
            }

            // JenisSubscription
            $curVal = trim(strval($this->JenisSubscription->CurrentValue));
            if ($curVal != "") {
                $this->JenisSubscription->ViewValue = $this->JenisSubscription->lookupCacheOption($curVal);
            } else {
                $this->JenisSubscription->ViewValue = $this->JenisSubscription->Lookup !== null && is_array($this->JenisSubscription->lookupOptions()) && count($this->JenisSubscription->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->JenisSubscription->ViewValue !== null) { // Load from cache
                $this->JenisSubscription->EditValue = array_values($this->JenisSubscription->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter($this->JenisSubscription->Lookup->getTable()->Fields["JenisSubscription"]->searchExpression(), "=", $this->JenisSubscription->CurrentValue, $this->JenisSubscription->Lookup->getTable()->Fields["JenisSubscription"]->searchDataType(), "");
                }
                $sqlWrk = $this->JenisSubscription->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCache($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->JenisSubscription->EditValue = $arwrk;
            }
            $this->JenisSubscription->PlaceHolder = RemoveHtml($this->JenisSubscription->caption());

            // BulanSubscription
            $this->BulanSubscription->setupEditAttributes();
            if (!$this->BulanSubscription->Raw) {
                $this->BulanSubscription->CurrentValue = HtmlDecode($this->BulanSubscription->CurrentValue);
            }
            $this->BulanSubscription->EditValue = HtmlEncode($this->BulanSubscription->CurrentValue);
            $this->BulanSubscription->PlaceHolder = RemoveHtml($this->BulanSubscription->caption());

            // KeteranganSubscription
            $this->KeteranganSubscription->setupEditAttributes();
            if (!$this->KeteranganSubscription->Raw) {
                $this->KeteranganSubscription->CurrentValue = HtmlDecode($this->KeteranganSubscription->CurrentValue);
            }
            $this->KeteranganSubscription->EditValue = HtmlEncode($this->KeteranganSubscription->CurrentValue);
            $this->KeteranganSubscription->PlaceHolder = RemoveHtml($this->KeteranganSubscription->caption());

            // Edit refer script

            // NomorPelanggan
            $this->NomorPelanggan->HrefValue = "";
            $this->NomorPelanggan->TooltipValue = "";

            // NamaPelanggan
            $this->NamaPelanggan->HrefValue = "";

            // IP
            $this->IP->HrefValue = "";

            // Bandwidth
            $this->Bandwidth->HrefValue = "";

            // Harga
            $this->Harga->HrefValue = "";

            // JenisSubscription
            $this->JenisSubscription->HrefValue = "";

            // BulanSubscription
            $this->BulanSubscription->HrefValue = "";

            // KeteranganSubscription
            $this->KeteranganSubscription->HrefValue = "";
        }
        if ($this->RowType == RowType::ADD || $this->RowType == RowType::EDIT || $this->RowType == RowType::SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != RowType::AGGREGATEINIT) {
            $this->rowRendered();
        }

        // Save data for Custom Template
        if ($this->RowType == RowType::VIEW || $this->RowType == RowType::EDIT || $this->RowType == RowType::ADD) {
            $this->Rows[] = $this->customTemplateFieldValues();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
            if ($this->NomorPelanggan->Visible && $this->NomorPelanggan->Required) {
                if (!$this->NomorPelanggan->IsDetailKey && EmptyValue($this->NomorPelanggan->FormValue)) {
                    $this->NomorPelanggan->addErrorMessage(str_replace("%s", $this->NomorPelanggan->caption(), $this->NomorPelanggan->RequiredErrorMessage));
                }
            }
            if ($this->NamaPelanggan->Visible && $this->NamaPelanggan->Required) {
                if (!$this->NamaPelanggan->IsDetailKey && EmptyValue($this->NamaPelanggan->FormValue)) {
                    $this->NamaPelanggan->addErrorMessage(str_replace("%s", $this->NamaPelanggan->caption(), $this->NamaPelanggan->RequiredErrorMessage));
                }
            }
            if ($this->IP->Visible && $this->IP->Required) {
                if (!$this->IP->IsDetailKey && EmptyValue($this->IP->FormValue)) {
                    $this->IP->addErrorMessage(str_replace("%s", $this->IP->caption(), $this->IP->RequiredErrorMessage));
                }
            }
            if ($this->Bandwidth->Visible && $this->Bandwidth->Required) {
                if ($this->Bandwidth->FormValue == "") {
                    $this->Bandwidth->addErrorMessage(str_replace("%s", $this->Bandwidth->caption(), $this->Bandwidth->RequiredErrorMessage));
                }
            }
            if ($this->Harga->Visible && $this->Harga->Required) {
                if (!$this->Harga->IsDetailKey && EmptyValue($this->Harga->FormValue)) {
                    $this->Harga->addErrorMessage(str_replace("%s", $this->Harga->caption(), $this->Harga->RequiredErrorMessage));
                }
            }
            if (!CheckInteger($this->Harga->FormValue)) {
                $this->Harga->addErrorMessage($this->Harga->getErrorMessage(false));
            }
            if ($this->JenisSubscription->Visible && $this->JenisSubscription->Required) {
                if ($this->JenisSubscription->FormValue == "") {
                    $this->JenisSubscription->addErrorMessage(str_replace("%s", $this->JenisSubscription->caption(), $this->JenisSubscription->RequiredErrorMessage));
                }
            }
            if ($this->BulanSubscription->Visible && $this->BulanSubscription->Required) {
                if (!$this->BulanSubscription->IsDetailKey && EmptyValue($this->BulanSubscription->FormValue)) {
                    $this->BulanSubscription->addErrorMessage(str_replace("%s", $this->BulanSubscription->caption(), $this->BulanSubscription->RequiredErrorMessage));
                }
            }
            if ($this->KeteranganSubscription->Visible && $this->KeteranganSubscription->Required) {
                if (!$this->KeteranganSubscription->IsDetailKey && EmptyValue($this->KeteranganSubscription->FormValue)) {
                    $this->KeteranganSubscription->addErrorMessage(str_replace("%s", $this->KeteranganSubscription->caption(), $this->KeteranganSubscription->RequiredErrorMessage));
                }
            }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Load old values
            $this->loadDbValues($rsold);
        }

        // Get new row
        $rsnew = $this->getEditRow($rsold);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check field with unique index (NomorPelanggan)
        if ($this->NomorPelanggan->CurrentValue != "") {
            $filterChk = "(`NomorPelanggan` = '" . AdjustSql($this->NomorPelanggan->CurrentValue, $this->Dbid) . "')";
            $filterChk .= " AND NOT (" . $filter . ")";
            $this->CurrentFilter = $filterChk;
            $sqlChk = $this->getCurrentSql();
            $rsChk = $conn->executeQuery($sqlChk);
            if (!$rsChk) {
                return false;
            }
            if ($rsChk->fetch()) {
                $idxErrMsg = str_replace("%f", $this->NomorPelanggan->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->NomorPelanggan->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }

        // Check field with unique index (NamaPelanggan)
        if ($this->NamaPelanggan->CurrentValue != "") {
            $filterChk = "(`NamaPelanggan` = '" . AdjustSql($this->NamaPelanggan->CurrentValue, $this->Dbid) . "')";
            $filterChk .= " AND NOT (" . $filter . ")";
            $this->CurrentFilter = $filterChk;
            $sqlChk = $this->getCurrentSql();
            $rsChk = $conn->executeQuery($sqlChk);
            if (!$rsChk) {
                return false;
            }
            if ($rsChk->fetch()) {
                $idxErrMsg = str_replace("%f", $this->NamaPelanggan->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->NamaPelanggan->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }

        // Check field with unique index (IP)
        if ($this->IP->CurrentValue != "") {
            $filterChk = "(`IP` = '" . AdjustSql($this->IP->CurrentValue, $this->Dbid) . "')";
            $filterChk .= " AND NOT (" . $filter . ")";
            $this->CurrentFilter = $filterChk;
            $sqlChk = $this->getCurrentSql();
            $rsChk = $conn->executeQuery($sqlChk);
            if (!$rsChk) {
                return false;
            }
            if ($rsChk->fetch()) {
                $idxErrMsg = str_replace("%f", $this->IP->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->IP->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);

        // Check for duplicate key when key changed
        if ($updateRow) {
            $newKeyFilter = $this->getRecordFilter($rsnew);
            if ($newKeyFilter != $oldKeyFilter) {
                $rsChk = $this->loadRs($newKeyFilter)->fetch();
                if ($rsChk !== false) {
                    $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                    $this->setFailureMessage($keyErrMsg);
                    $updateRow = false;
                }
            }
        }
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    /**
     * Get edit row
     *
     * @return array
     */
    protected function getEditRow($rsold)
    {
        global $Security;
        $rsnew = [];

        // NamaPelanggan
        $this->NamaPelanggan->setDbValueDef($rsnew, $this->NamaPelanggan->CurrentValue, $this->NamaPelanggan->ReadOnly);

        // IP
        $this->IP->setDbValueDef($rsnew, $this->IP->CurrentValue, $this->IP->ReadOnly);

        // Bandwidth
        $this->Bandwidth->setDbValueDef($rsnew, $this->Bandwidth->CurrentValue, $this->Bandwidth->ReadOnly);

        // Harga
        $this->Harga->setDbValueDef($rsnew, $this->Harga->CurrentValue, $this->Harga->ReadOnly);

        // JenisSubscription
        $this->JenisSubscription->setDbValueDef($rsnew, $this->JenisSubscription->CurrentValue, $this->JenisSubscription->ReadOnly);

        // BulanSubscription
        $this->BulanSubscription->setDbValueDef($rsnew, $this->BulanSubscription->CurrentValue, $this->BulanSubscription->ReadOnly);

        // KeteranganSubscription
        $this->KeteranganSubscription->setDbValueDef($rsnew, $this->KeteranganSubscription->CurrentValue, $this->KeteranganSubscription->ReadOnly);
        return $rsnew;
    }

    /**
     * Restore edit form from row
     * @param array $row Row
     */
    protected function restoreEditFormFromRow($row)
    {
        if (isset($row['NamaPelanggan'])) { // NamaPelanggan
            $this->NamaPelanggan->CurrentValue = $row['NamaPelanggan'];
        }
        if (isset($row['IP'])) { // IP
            $this->IP->CurrentValue = $row['IP'];
        }
        if (isset($row['Bandwidth'])) { // Bandwidth
            $this->Bandwidth->CurrentValue = $row['Bandwidth'];
        }
        if (isset($row['Harga'])) { // Harga
            $this->Harga->CurrentValue = $row['Harga'];
        }
        if (isset($row['JenisSubscription'])) { // JenisSubscription
            $this->JenisSubscription->CurrentValue = $row['JenisSubscription'];
        }
        if (isset($row['BulanSubscription'])) { // BulanSubscription
            $this->BulanSubscription->CurrentValue = $row['BulanSubscription'];
        }
        if (isset($row['KeteranganSubscription'])) { // KeteranganSubscription
            $this->KeteranganSubscription->CurrentValue = $row['KeteranganSubscription'];
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("DataPelangganList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_Bandwidth":
                    break;
                case "x_JenisSubscription":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == "success") {
            //$msg = "your success message";
        } elseif ($type == "failure") {
            //$msg = "your failure message";
        } elseif ($type == "warning") {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
