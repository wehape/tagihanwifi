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
 * Table class for data_pelanggan
 */
class DataPelanggan extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Ajax / Modal
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = false;
    public $ModalEdit = false;
    public $ModalUpdate = false;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;

    // Fields
    public $NomorPelanggan;
    public $NamaPelanggan;
    public $IP;
    public $Bandwidth;
    public $Harga;
    public $JenisSubscription;
    public $BulanSubscription;
    public $KeteranganSubscription;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("app.language");
        $this->TableVar = "data_pelanggan";
        $this->TableName = 'data_pelanggan';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "data_pelanggan";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // NomorPelanggan
        $this->NomorPelanggan = new DbField(
            $this, // Table
            'x_NomorPelanggan', // Variable name
            'NomorPelanggan', // Name
            '`NomorPelanggan`', // Expression
            '`NomorPelanggan`', // Basic search expression
            200, // Type
            12, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`NomorPelanggan`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->NomorPelanggan->InputTextType = "text";
        $this->NomorPelanggan->Raw = true;
        $this->NomorPelanggan->IsPrimaryKey = true; // Primary key field
        $this->NomorPelanggan->Nullable = false; // NOT NULL field
        $this->NomorPelanggan->Required = true; // Required field
        $this->NomorPelanggan->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['NomorPelanggan'] = &$this->NomorPelanggan;

        // NamaPelanggan
        $this->NamaPelanggan = new DbField(
            $this, // Table
            'x_NamaPelanggan', // Variable name
            'NamaPelanggan', // Name
            '`NamaPelanggan`', // Expression
            '`NamaPelanggan`', // Basic search expression
            200, // Type
            64, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`NamaPelanggan`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->NamaPelanggan->InputTextType = "text";
        $this->NamaPelanggan->Nullable = false; // NOT NULL field
        $this->NamaPelanggan->Required = true; // Required field
        $this->NamaPelanggan->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['NamaPelanggan'] = &$this->NamaPelanggan;

        // IP
        $this->IP = new DbField(
            $this, // Table
            'x_IP', // Variable name
            'IP', // Name
            '`IP`', // Expression
            '`IP`', // Basic search expression
            200, // Type
            24, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`IP`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->IP->InputTextType = "text";
        $this->IP->Nullable = false; // NOT NULL field
        $this->IP->Required = true; // Required field
        $this->IP->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['IP'] = &$this->IP;

        // Bandwidth
        $this->Bandwidth = new DbField(
            $this, // Table
            'x_Bandwidth', // Variable name
            'Bandwidth', // Name
            '`Bandwidth`', // Expression
            '`Bandwidth`', // Basic search expression
            200, // Type
            24, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Bandwidth`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'RADIO' // Edit Tag
        );
        $this->Bandwidth->InputTextType = "text";
        $this->Bandwidth->Nullable = false; // NOT NULL field
        $this->Bandwidth->Required = true; // Required field
        $this->Bandwidth->Lookup = new Lookup($this->Bandwidth, 'bandwidth', true, 'Bandwidth', ["Bandwidth","","",""], '', '', [], [], [], [], ["Harga"], ["x_Harga"], false, '`NomorBandwidth` ASC', '', "`Bandwidth`");
        $this->Bandwidth->SearchOperators = ["=", "<>"];
        $this->Fields['Bandwidth'] = &$this->Bandwidth;

        // Harga
        $this->Harga = new DbField(
            $this, // Table
            'x_Harga', // Variable name
            'Harga', // Name
            '`Harga`', // Expression
            '`Harga`', // Basic search expression
            3, // Type
            12, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`Harga`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->Harga->InputTextType = "text";
        $this->Harga->Raw = true;
        $this->Harga->Nullable = false; // NOT NULL field
        $this->Harga->Required = true; // Required field
        $this->Harga->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Harga->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['Harga'] = &$this->Harga;

        // JenisSubscription
        $this->JenisSubscription = new DbField(
            $this, // Table
            'x_JenisSubscription', // Variable name
            'JenisSubscription', // Name
            '`JenisSubscription`', // Expression
            '`JenisSubscription`', // Basic search expression
            200, // Type
            240, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`JenisSubscription`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'RADIO' // Edit Tag
        );
        $this->JenisSubscription->InputTextType = "text";
        $this->JenisSubscription->Nullable = false; // NOT NULL field
        $this->JenisSubscription->Required = true; // Required field
        $this->JenisSubscription->Lookup = new Lookup($this->JenisSubscription, 'subscription', true, 'JenisSubscription', ["JenisSubscription","","",""], '', '', [], [], [], [], ["BulanSubscription","KeteranganSubscription"], ["x_BulanSubscription","x_KeteranganSubscription"], false, '`NomorSubscription` ASC', '', "`JenisSubscription`");
        $this->JenisSubscription->SearchOperators = ["=", "<>"];
        $this->Fields['JenisSubscription'] = &$this->JenisSubscription;

        // BulanSubscription
        $this->BulanSubscription = new DbField(
            $this, // Table
            'x_BulanSubscription', // Variable name
            'BulanSubscription', // Name
            '`BulanSubscription`', // Expression
            '`BulanSubscription`', // Basic search expression
            200, // Type
            240, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`BulanSubscription`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->BulanSubscription->InputTextType = "text";
        $this->BulanSubscription->Nullable = false; // NOT NULL field
        $this->BulanSubscription->Required = true; // Required field
        $this->BulanSubscription->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['BulanSubscription'] = &$this->BulanSubscription;

        // KeteranganSubscription
        $this->KeteranganSubscription = new DbField(
            $this, // Table
            'x_KeteranganSubscription', // Variable name
            'KeteranganSubscription', // Name
            '`KeteranganSubscription`', // Expression
            '`KeteranganSubscription`', // Basic search expression
            200, // Type
            240, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`KeteranganSubscription`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->KeteranganSubscription->InputTextType = "text";
        $this->KeteranganSubscription->Nullable = false; // NOT NULL field
        $this->KeteranganSubscription->Required = true; // Required field
        $this->KeteranganSubscription->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['KeteranganSubscription'] = &$this->KeteranganSubscription;

        // Add Doctrine Cache
        $this->Cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
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
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Get FROM clause
    public function getSqlFrom()
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "data_pelanggan";
    }

    // Get FROM clause (for backward compatibility)
    public function sqlFrom()
    {
        return $this->getSqlFrom();
    }

    // Set FROM clause
    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    // Get SELECT clause
    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select($this->sqlSelectFields());
    }

    // Get list of fields
    private function sqlSelectFields()
    {
        $useFieldNames = false;
        $fieldNames = [];
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($this->Fields as $field) {
            $expr = $field->Expression;
            $customExpr = $field->CustomDataType?->convertToPHPValueSQL($expr, $platform) ?? $expr;
            if ($customExpr != $expr) {
                $fieldNames[] = $customExpr . " AS " . QuotedName($field->Name, $this->Dbid);
                $useFieldNames = true;
            } else {
                $fieldNames[] = $expr;
            }
        }
        return $useFieldNames ? implode(", ", $fieldNames) : "*";
    }

    // Get SELECT clause (for backward compatibility)
    public function sqlSelect()
    {
        return $this->getSqlSelect();
    }

    // Set SELECT clause
    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    // Get WHERE clause
    public function getSqlWhere()
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    // Get WHERE clause (for backward compatibility)
    public function sqlWhere()
    {
        return $this->getSqlWhere();
    }

    // Set WHERE clause
    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    // Get GROUP BY clause
    public function getSqlGroupBy()
    {
        return $this->SqlGroupBy != "" ? $this->SqlGroupBy : "";
    }

    // Get GROUP BY clause (for backward compatibility)
    public function sqlGroupBy()
    {
        return $this->getSqlGroupBy();
    }

    // set GROUP BY clause
    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    // Get HAVING clause
    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    // Get HAVING clause (for backward compatibility)
    public function sqlHaving()
    {
        return $this->getSqlHaving();
    }

    // Set HAVING clause
    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    // Get ORDER BY clause
    public function getSqlOrderBy()
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    // Get ORDER BY clause (for backward compatibility)
    public function sqlOrderBy()
    {
        return $this->getSqlOrderBy();
    }

    // set ORDER BY clause
    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return ($allow & Allow::ADD->value) == Allow::ADD->value;
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return ($allow & Allow::EDIT->value) == Allow::EDIT->value;
            case "delete":
                return ($allow & Allow::DELETE->value) == Allow::DELETE->value;
            case "view":
                return ($allow & Allow::VIEW->value) == Allow::VIEW->value;
            case "search":
                return ($allow & Allow::SEARCH->value) == Allow::SEARCH->value;
            case "lookup":
                return ($allow & Allow::LOOKUP->value) == Allow::LOOKUP->value;
            default:
                return ($allow & Allow::LIST->value) == Allow::LIST->value;
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $sqlwrk = $sql instanceof QueryBuilder // Query builder
            ? (clone $sql)->resetQueryPart("orderBy")->getSQL()
            : $sql;
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            in_array($this->TableType, ["TABLE", "VIEW", "LINKTABLE"]) &&
            preg_match($pattern, $sqlwrk) &&
            !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*SELECT\s+DISTINCT\s+/i', $sqlwrk) &&
            !preg_match('/\s+ORDER\s+BY\s+/i', $sqlwrk)
        ) {
            $sqlcnt = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlcnt = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlcnt);
        if ($cnt !== false) {
            return (int)$cnt;
        }
        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        $result = $conn->executeQuery($sqlwrk);
        $cnt = $result->rowCount();
        if ($cnt == 0) { // Unable to get record count, count directly
            while ($result->fetch()) {
                $cnt++;
            }
        }
        return $cnt;
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        );
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
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
        $this->recordsetSelecting($filter);
        $isCustomView = $this->TableType == "CUSTOMVIEW";
        $select = $isCustomView ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $isCustomView ? $this->getSqlGroupBy() : "";
        $having = $isCustomView ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->setValue($field->Expression, $parm);
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        try {
            $queryBuilder = $this->insertSql($rs);
            $result = $queryBuilder->executeStatement();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $result = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($result) {
        }
        return $result;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        $platform = $this->getConnection()->getDatabasePlatform();
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $field = $this->Fields[$name];
            $parm = $queryBuilder->createPositionalParameter($value, $field->getParameterType());
            $parm = $field->CustomDataType?->convertToDatabaseValueSQL($parm, $platform) ?? $parm; // Convert database SQL
            $queryBuilder->set($field->Expression, $parm);
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->executeStatement();
            $success = $success > 0 ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('NomorPelanggan', $rs)) {
                AddFilter($where, QuotedName('NomorPelanggan', $this->Dbid) . '=' . QuotedValue($rs['NomorPelanggan'], $this->NomorPelanggan->DataType, $this->Dbid));
            }
        }
        $filter = $curfilter ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->executeStatement();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
        }
        return $success;
    }

    // Load DbValue from result set or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->NomorPelanggan->DbValue = $row['NomorPelanggan'];
        $this->NamaPelanggan->DbValue = $row['NamaPelanggan'];
        $this->IP->DbValue = $row['IP'];
        $this->Bandwidth->DbValue = $row['Bandwidth'];
        $this->Harga->DbValue = $row['Harga'];
        $this->JenisSubscription->DbValue = $row['JenisSubscription'];
        $this->BulanSubscription->DbValue = $row['BulanSubscription'];
        $this->KeteranganSubscription->DbValue = $row['KeteranganSubscription'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`NomorPelanggan` = '@NomorPelanggan@'";
    }

    // Get Key
    public function getKey($current = false, $keySeparator = null)
    {
        $keys = [];
        $val = $current ? $this->NomorPelanggan->CurrentValue : $this->NomorPelanggan->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        return implode($keySeparator, $keys);
    }

    // Set Key
    public function setKey($key, $current = false, $keySeparator = null)
    {
        $keySeparator ??= Config("COMPOSITE_KEY_SEPARATOR");
        $this->OldKey = strval($key);
        $keys = explode($keySeparator, $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->NomorPelanggan->CurrentValue = $keys[0];
            } else {
                $this->NomorPelanggan->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('NomorPelanggan', $row) ? $row['NomorPelanggan'] : null;
        } else {
            $val = !EmptyValue($this->NomorPelanggan->OldValue) && !$current ? $this->NomorPelanggan->OldValue : $this->NomorPelanggan->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NomorPelanggan@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("DataPelangganList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        return match ($pageName) {
            "DataPelangganView" => $Language->phrase("View"),
            "DataPelangganEdit" => $Language->phrase("Edit"),
            "DataPelangganAdd" => $Language->phrase("Add"),
            default => ""
        };
    }

    // Default route URL
    public function getDefaultRouteUrl()
    {
        return "DataPelangganList";
    }

    // API page name
    public function getApiPageName($action)
    {
        return match (strtolower($action)) {
            Config("API_VIEW_ACTION") => "DataPelangganView",
            Config("API_ADD_ACTION") => "DataPelangganAdd",
            Config("API_EDIT_ACTION") => "DataPelangganEdit",
            Config("API_DELETE_ACTION") => "DataPelangganDelete",
            Config("API_LIST_ACTION") => "DataPelangganList",
            default => ""
        };
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "DataPelangganList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("DataPelangganView", $parm);
        } else {
            $url = $this->keyUrl("DataPelangganView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "DataPelangganAdd?" . $parm;
        } else {
            $url = "DataPelangganAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("DataPelangganEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("DataPelangganList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("DataPelangganAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("DataPelangganList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl($parm = "")
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("DataPelangganDelete", $parm);
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"NomorPelanggan\":" . VarToJson($this->NomorPelanggan->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->NomorPelanggan->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->NomorPelanggan->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($this->PageID != "grid" && $fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($this->PageID != "grid" && !$this->isExport() && $fld->UseFilter) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") .
                (is_array($fld->EditValue) ? str_replace("%c", count($fld->EditValue), $Language->phrase("FilterCount")) : '') .
                '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;" . Config("PAGE_DASHBOARD") . "=" . $DashboardReport;
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            $isApi = IsApi();
            $keyValues = $isApi
                ? (Route(0) == "export"
                    ? array_map(fn ($i) => Route($i + 3), range(0, 0))  // Export API
                    : array_map(fn ($i) => Route($i + 2), range(0, 0))) // Other API
                : []; // Non-API
            if (($keyValue = Param("NomorPelanggan") ?? Route("NomorPelanggan")) !== null) {
                $arKeys[] = $keyValue;
            } elseif ($isApi && (($keyValue = Key(0) ?? $keyValues[0] ?? null) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        $keyFilter = "";
        foreach ($rows as $row) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter($row) . ")";
        }
        return $keyFilter;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->NomorPelanggan->CurrentValue = $key;
            } else {
                $this->NomorPelanggan->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load result set based on filter/sort
    public function loadRs($filter, $sort = "")
    {
        $sql = $this->getSql($filter, $sort); // Set up filter (WHERE Clause) / sort (ORDER BY Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->NomorPelanggan->setDbValue($row['NomorPelanggan']);
        $this->NamaPelanggan->setDbValue($row['NamaPelanggan']);
        $this->IP->setDbValue($row['IP']);
        $this->Bandwidth->setDbValue($row['Bandwidth']);
        $this->Harga->setDbValue($row['Harga']);
        $this->JenisSubscription->setDbValue($row['JenisSubscription']);
        $this->BulanSubscription->setDbValue($row['BulanSubscription']);
        $this->KeteranganSubscription->setDbValue($row['KeteranganSubscription']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "DataPelangganList";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("app.view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NomorPelanggan
        $this->NomorPelanggan->CellCssStyle = "min-width: 150px; white-space: nowrap;";

        // NamaPelanggan
        $this->NamaPelanggan->CellCssStyle = "min-width: 200px; white-space: nowrap;";

        // IP
        $this->IP->CellCssStyle = "min-width: 150px; white-space: nowrap;";

        // Bandwidth
        $this->Bandwidth->CellCssStyle = "min-width: 150px; white-space: nowrap;";

        // Harga
        $this->Harga->CellCssStyle = "min-width: 150px; white-space: nowrap;";

        // JenisSubscription
        $this->JenisSubscription->CellCssStyle = "min-width: 200px; white-space: nowrap;";

        // BulanSubscription
        $this->BulanSubscription->CellCssStyle = "min-width: 150px; white-space: nowrap;";

        // KeteranganSubscription
        $this->KeteranganSubscription->CellCssStyle = "min-width: 250px; white-space: nowrap;";

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
        $this->NamaPelanggan->TooltipValue = "";

        // IP
        $this->IP->HrefValue = "";
        $this->IP->TooltipValue = "";

        // Bandwidth
        $this->Bandwidth->HrefValue = "";
        $this->Bandwidth->TooltipValue = "";

        // Harga
        $this->Harga->HrefValue = "";
        $this->Harga->TooltipValue = "";

        // JenisSubscription
        $this->JenisSubscription->HrefValue = "";
        $this->JenisSubscription->TooltipValue = "";

        // BulanSubscription
        $this->BulanSubscription->HrefValue = "";
        $this->BulanSubscription->TooltipValue = "";

        // KeteranganSubscription
        $this->KeteranganSubscription->HrefValue = "";
        $this->KeteranganSubscription->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // NomorPelanggan
        $this->NomorPelanggan->setupEditAttributes();
        $this->NomorPelanggan->EditValue = $this->NomorPelanggan->CurrentValue;

        // NamaPelanggan
        $this->NamaPelanggan->setupEditAttributes();
        if (!$this->NamaPelanggan->Raw) {
            $this->NamaPelanggan->CurrentValue = HtmlDecode($this->NamaPelanggan->CurrentValue);
        }
        $this->NamaPelanggan->EditValue = $this->NamaPelanggan->CurrentValue;
        $this->NamaPelanggan->PlaceHolder = RemoveHtml($this->NamaPelanggan->caption());

        // IP
        $this->IP->setupEditAttributes();
        if (!$this->IP->Raw) {
            $this->IP->CurrentValue = HtmlDecode($this->IP->CurrentValue);
        }
        $this->IP->EditValue = $this->IP->CurrentValue;
        $this->IP->PlaceHolder = RemoveHtml($this->IP->caption());

        // Bandwidth
        $this->Bandwidth->PlaceHolder = RemoveHtml($this->Bandwidth->caption());

        // Harga
        $this->Harga->setupEditAttributes();
        $this->Harga->EditValue = $this->Harga->CurrentValue;
        $this->Harga->PlaceHolder = RemoveHtml($this->Harga->caption());
        if (strval($this->Harga->EditValue) != "" && is_numeric($this->Harga->EditValue)) {
            $this->Harga->EditValue = FormatNumber($this->Harga->EditValue, null);
        }

        // JenisSubscription
        $this->JenisSubscription->PlaceHolder = RemoveHtml($this->JenisSubscription->caption());

        // BulanSubscription
        $this->BulanSubscription->setupEditAttributes();
        if (!$this->BulanSubscription->Raw) {
            $this->BulanSubscription->CurrentValue = HtmlDecode($this->BulanSubscription->CurrentValue);
        }
        $this->BulanSubscription->EditValue = $this->BulanSubscription->CurrentValue;
        $this->BulanSubscription->PlaceHolder = RemoveHtml($this->BulanSubscription->caption());

        // KeteranganSubscription
        $this->KeteranganSubscription->setupEditAttributes();
        if (!$this->KeteranganSubscription->Raw) {
            $this->KeteranganSubscription->CurrentValue = HtmlDecode($this->KeteranganSubscription->CurrentValue);
        }
        $this->KeteranganSubscription->EditValue = $this->KeteranganSubscription->CurrentValue;
        $this->KeteranganSubscription->PlaceHolder = RemoveHtml($this->KeteranganSubscription->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $result, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$result || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->NomorPelanggan);
                    $doc->exportCaption($this->NamaPelanggan);
                    $doc->exportCaption($this->IP);
                    $doc->exportCaption($this->Bandwidth);
                    $doc->exportCaption($this->Harga);
                    $doc->exportCaption($this->JenisSubscription);
                    $doc->exportCaption($this->BulanSubscription);
                    $doc->exportCaption($this->KeteranganSubscription);
                } else {
                    $doc->exportCaption($this->NomorPelanggan);
                    $doc->exportCaption($this->NamaPelanggan);
                    $doc->exportCaption($this->IP);
                    $doc->exportCaption($this->Bandwidth);
                    $doc->exportCaption($this->Harga);
                    $doc->exportCaption($this->JenisSubscription);
                    $doc->exportCaption($this->BulanSubscription);
                    $doc->exportCaption($this->KeteranganSubscription);
                }
                $doc->endExportRow();
            }
        }
        $recCnt = $startRec - 1;
        $stopRec = $stopRec > 0 ? $stopRec : PHP_INT_MAX;
        while (($row = $result->fetch()) && $recCnt < $stopRec) {
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = RowType::VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->NomorPelanggan);
                        $doc->exportField($this->NamaPelanggan);
                        $doc->exportField($this->IP);
                        $doc->exportField($this->Bandwidth);
                        $doc->exportField($this->Harga);
                        $doc->exportField($this->JenisSubscription);
                        $doc->exportField($this->BulanSubscription);
                        $doc->exportField($this->KeteranganSubscription);
                    } else {
                        $doc->exportField($this->NomorPelanggan);
                        $doc->exportField($this->NamaPelanggan);
                        $doc->exportField($this->IP);
                        $doc->exportField($this->Bandwidth);
                        $doc->exportField($this->Harga);
                        $doc->exportField($this->JenisSubscription);
                        $doc->exportField($this->BulanSubscription);
                        $doc->exportField($this->KeteranganSubscription);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
            }
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Table level events

    // Table Load event
    public function tableLoad()
    {
        // Enter your code here
    }

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected($rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    public function rowInserting($rsold, &$rsnew) {
    	$rsnew["NomorPelanggan"] = NomorPelanggan();
        if ($rsnew["NamaPelanggan"] != "") {
    		$awal_pelanggan = ucwords($rsnew["NamaPelanggan"]);
    		$rsnew["NamaPelanggan"] = $awal_pelanggan;
    	}
    	return TRUE;
    }

    // Row Inserted event
    public function rowInserted($rsold, $rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        if ($rsnew["NamaPelanggan"] != "") {
    		$awal_pelanggan = ucwords($rsnew["NamaPelanggan"]);
    		$rsnew["NamaPelanggan"] = $awal_pelanggan;
    	}
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, $rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted($rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, $args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    public function rowRendered() {
    	if (CurrentPageID() == "add" && $this->CurrentAction != "F") {
    		$this->NomorPelanggan->CurrentValue = NomorPelanggan();
    		$this->NomorPelanggan->EditValue = $this->NomorPelanggan->CurrentValue;
    		$this->NomorPelanggan->ReadOnly = TRUE;
            $this->Harga->ReadOnly = TRUE;
    	}
    	if ($this->CurrentAction == "add" && $this->CurrentAction=="F") {
    		$this->NomorPelanggan->ViewValue = $this->NomorPelanggan->CurrentValue;
    	}
        if (CurrentPageID() == "edit" && $this->CurrentAction != "F") {
            $this->Harga->ReadOnly = TRUE;
    	}
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
