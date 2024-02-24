<?php

namespace PHPMaker2024\tagihanwifi01;

use Illuminate\Support\Collection;

/**
 * Report field class
 */
class ReportField extends DbField
{
    public $SumValue; // Sum
    public $AvgValue; // Average
    public $MinValue; // Minimum
    public $MaxValue; // Maximum
    public $CntValue; // Count
    public $SumViewValue; // Sum
    public $AvgViewValue; // Average
    public $MinViewValue; // Minimum
    public $MaxViewValue; // Maximum
    public $CntViewValue; // Count
    public $DrillDownTable = ""; // Drill down table name
    public $DrillDownUrl = ""; // Drill down URL
    public $CurrentFilter = ""; // Current filter in use
    public $GroupingFieldId = 0; // Grouping field id
    public $ShowGroupHeaderAsRow = false; // Show grouping level as row
    public $ShowCompactSummaryFooter = true; // Show compact summary footer
    public $GroupByType; // Group By Type
    public $GroupInterval; // Group Interval
    public $GroupSql; // Group SQL
    public $GroupValue; // Group Value
    public $GroupViewValue; // Group View Value
    public $DateFilter; // Date Filter ("year"|"quarter"|"month"|"day"|"")
    public $Delimiter = ""; // Field delimiter (e.g. comma) for delimiter separated value
    public $DistinctValues = [];
    public $Records = [];
    public $LevelBreak = false;
    public $Expanded = true;
    public $DashboardSearchSourceFields = [];
    public $SearchType = "";

    // Database value (override PHPMaker)
    public function setDbValue($v)
    {
        if ($this->Type == 131 || $this->Type == 139) { // Convert adNumeric/adVarNumeric field
            $v = floatval($v);
        }
        parent::setDbValue($v); // Call parent method
    }

    // Group value
    public function groupValue()
    {
        return $this->GroupValue;
    }

    // Set group value
    public function setGroupValue($v)
    {
        $this->setDbValue($v);
        $this->GroupValue = $this->DbValue;
    }

    // Get distinct values
    public function getDistinctValues($records, $sort = "ASC")
    {
        $name = $this->getGroupName();
        if (SameText($sort, "DESC")) {
            $this->DistinctValues = Collection::make($records)
                ->pluck($name)
                ->sortByDesc($name)
                ->unique()
                ->all();
        } else {
            $this->DistinctValues = Collection::make($records)
                ->pluck($name)
                ->sortBy($name)
                ->unique()
                ->all();
        }
    }

    // Get distinct records
    public function getDistinctRecords($records, $val)
    {
        $name = $this->getGroupName();
        $this->Records = Collection::make($records)
            ->where($name, $val)
            ->all();
    }

    // Get Sum
    public function getSum($records)
    {
        $name = $this->getGroupName();
        $sum = 0;
        if (count($records) > 0) {
            $sum = Collection::make($records)->sum($name);
        }
        $this->SumValue = $sum;
    }

    // Get Avg
    public function getAvg($records)
    {
        $name = $this->getGroupName();
        $avg = 0;
        if (count($records) > 0) {
            $avg = Collection::make($records)->average($name);
        }
        $this->AvgValue = $avg;
    }

    // Get Min
    public function getMin($records)
    {
        $name = $this->getGroupName();
        $min = null;
        if (count($records) > 0) {
            $collection = Collection::make($records)->whereNotNull($name);
            if (!$collection->isEmpty()) {
                $max = $collection->min($name);
            }
        }
        $this->MinValue = $min;
    }

    // Get Max
    public function getMax($records)
    {
        $name = $this->getGroupName();
        $max = null;
        if (count($records) > 0) {
            $collection = Collection::make($records)->whereNotNull($name);
            if (!$collection->isEmpty()) {
                $max = $collection->max($name);
            }
        }
        $this->MaxValue = $max;
    }

    // Get Count
    public function getCnt($records)
    {
        $name = $this->getGroupName();
        $cnt = 0;
        if (count($records) > 0) {
            $cnt = Collection::make($records)->count();
        }
        $this->CntValue = $cnt;
        $this->Count = $cnt;
    }

    // Get group name
    public function getGroupName()
    {
        return $this->GroupSql != "" ? "EW_GROUP_VALUE_" . $this->GroupingFieldId : $this->Name;
    }

    /**
     * Format advanced filters
     *
     * @param array $ar
     */
    public function formatAdvancedFilters($ar)
    {
        if (is_array($ar) && is_array($this->AdvancedFilters)) {
            foreach ($ar as &$arwrk) {
                $lf = $arwrk["lf"] ?? "";
                $df = $arwrk["df"] ?? "";
                if (StartsString("@@", $lf) && SameString($lf, $df)) {
                    $key = substr($lf, 2);
                    if (array_key_exists($key, $this->AdvancedFilters)) {
                        $arwrk["df"] = $this->AdvancedFilters[$key]->Name;
                    }
                }
            }
        }
        return $ar;
    }

    /**
     * Search expression
     *
     * @return string Search expression
     */
    public function searchExpression()
    {
        if (!EmptyValue($this->DateFilter)) { // Date filter
            return match (strtolower($this->DateFilter)) {
                "year" => GroupSql($this->Expression, "y", 0, $this->Table->Dbid),
                "quarter" => GroupSql($this->Expression, "q", 0, $this->Table->Dbid),
                "month" => GroupSql($this->Expression, "m", 0, $this->Table->Dbid),
                "week" => GroupSql($this->Expression, "w", 0, $this->Table->Dbid),
                "day" => GroupSql($this->Expression, "d", 0, $this->Table->Dbid),
                "hour" => GroupSql($this->Expression, "h", 0, $this->Table->Dbid),
                "minute" => GroupSql($this->Expression, "min", 0, $this->Table->Dbid),
                default => $this->Expression
            };
        } elseif ($this->GroupSql != "") { // Use grouping SQL for search if exists
            return str_replace("%s", $this->Expression, $this->GroupSql);
        }
        return parent::searchExpression();
    }

    /**
     * Search field type
     *
     * @return enum Search data type
     */
    public function searchDataType()
    {
        if (!EmptyValue($this->DateFilter)) { // Date filter
            return match (strtolower($this->DateFilter)) {
                "year" => DataType::NUMBER,
                "quarter" => DataType::STRING,
                "month" => DataType::STRING,
                "week" => DataType::STRING,
                "day" => DataType::STRING,
                "hour" => DataType::NUMBER,
                "minute" => DataType::NUMBER,
                default => $this->DataType
            };
        } elseif ($this->GroupSql != "") { // Use grouping SQL for search if exists
            return DataType::STRING;
        }
        return parent::searchDataType();
    }

    /**
     * Group toggle icon
     *
     * @return string Group toggle icon
     */
    public function groupToggleIcon()
    {
        $iconClass = "ew-group-toggle fa-solid fa-caret-down" . ($this->Expanded || $this->Table->hideGroupLevel() != $this->GroupingFieldId ? "" : " ew-rpt-grp-hide");
        return '<i class="' . $iconClass . '"></i>';
    }

    /**
     * Expand group
     *
     * @param bool $value Expanded
     */
    public function setExpanded(bool $value)
    {
        foreach ($this->Table->Fields as $fld) {
            if ($fld->GroupingFieldId >= $this->GroupingFieldId) {
                $fld->Expanded = $value;
            }
        }
    }

    /**
     * Cell attributes
     *
     * @return string Cell attributes
     */
    public function cellAttributes($className = "") {
        if ($className) {
            $this->CellAttrs->AppendClass($className);
        }
        $cellAttrs = parent::cellAttributes(); // Call parent method
        if ($className) {
            $this->CellAttrs->removeClass($className);
        }
        return $cellAttrs;
    }
}
