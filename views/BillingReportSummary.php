<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$BillingReportSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Billing_Report: currentTable } });
var currentPageID = ew.PAGE_ID = "summary";
var currentForm;
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->ShowReport) { ?>
<!-- Summary report (begin) -->
<main class="report-summary<?= ($Page->TotalGroups == 0) ? " ew-no-record" : "" ?>">
<?php
while ($Page->GroupCount <= count($Page->GroupRecords) && $Page->GroupCount <= $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<?php if ($Page->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Page->TotalGroups > 0) { ?>
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0) && $Page->Pager->Visible) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?= $Page->PageBreakHtml ?>
<?php } ?>
<div class="<?= $Page->ReportContainerClass ?>">
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0) && $Page->Pager->Visible) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Billing_Report" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>">
<table class="<?= $Page->TableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->Tahun->Visible) { ?>
    <?php if ($Page->Tahun->ShowGroupHeaderAsRow) { ?>
    <th data-name="Tahun"<?= $Page->Tahun->cellAttributes("ew-rpt-grp-caret") ?>><?= $Page->Tahun->groupToggleIcon() ?></th>
    <?php } else { ?>
    <th data-name="Tahun" class="<?= $Page->Tahun->headerCellClass() ?>" style="min-width: 150px; white-space: nowrap;"><div class="Billing_Report_Tahun"><?= $Page->renderFieldHeader($Page->Tahun) ?></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->Bulan->Visible) { ?>
    <?php if ($Page->Bulan->ShowGroupHeaderAsRow) { ?>
    <th data-name="Bulan">&nbsp;</th>
    <?php } else { ?>
    <th data-name="Bulan" class="<?= $Page->Bulan->headerCellClass() ?>" style="min-width: 150px; white-space: nowrap;"><div class="Billing_Report_Bulan"><?= $Page->renderFieldHeader($Page->Bulan) ?></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { ?>
    <?php if ($Page->Tanggal->ShowGroupHeaderAsRow) { ?>
    <th data-name="Tanggal">&nbsp;</th>
    <?php } else { ?>
    <th data-name="Tanggal" class="<?= $Page->Tanggal->headerCellClass() ?>" style="min-width: 150px; white-space: nowrap;"><div class="Billing_Report_Tanggal"><?= $Page->renderFieldHeader($Page->Tanggal) ?></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->Status->Visible) { ?>
    <?php if ($Page->Status->ShowGroupHeaderAsRow) { ?>
    <th data-name="Status">&nbsp;</th>
    <?php } else { ?>
    <th data-name="Status" class="<?= $Page->Status->headerCellClass() ?>" style="min-width: 150px; white-space: nowrap;"><div class="Billing_Report_Status"><?= $Page->renderFieldHeader($Page->Status) ?></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->NomorBC->Visible) { ?>
    <th data-name="NomorBC" class="<?= $Page->NomorBC->headerCellClass() ?>" style="min-width: 150px; white-space: nowrap;"><div class="Billing_Report_NomorBC"><?= $Page->renderFieldHeader($Page->NomorBC) ?></div></th>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { ?>
    <th data-name="NamaPelanggan" class="<?= $Page->NamaPelanggan->headerCellClass() ?>" style="min-width: 200px; white-space: nowrap;"><div class="Billing_Report_NamaPelanggan"><?= $Page->renderFieldHeader($Page->NamaPelanggan) ?></div></th>
<?php } ?>
<?php if ($Page->Tagihan->Visible) { ?>
    <th data-name="Tagihan" class="<?= $Page->Tagihan->headerCellClass() ?>" style="min-width: 150px; white-space: nowrap;"><div class="Billing_Report_Tagihan"><?= $Page->renderFieldHeader($Page->Tagihan) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php

    // Build detail SQL
    $where = DetailFilterSql($Page->Tahun, $Page->getSqlFirstGroupField(), $Page->Tahun->groupValue(), $Page->Dbid);
    AddFilter($Page->PageFirstGroupFilter, $where, "OR");
    AddFilter($where, $Page->Filter);
    $sql = $Page->buildReportSql($Page->getSqlSelect(), $Page->getSqlFrom(), $Page->getSqlWhere(), $Page->getSqlGroupBy(), $Page->getSqlHaving(), $Page->getSqlOrderBy(), $where, $Page->Sort);
    $rs = $sql->executeQuery();
    $Page->DetailRecords = $rs?->fetchAll() ?? [];
    $Page->DetailRecordCount = count($Page->DetailRecords);

    // Load detail records
    $Page->Tahun->Records = &$Page->DetailRecords;
    $Page->Tahun->LevelBreak = true; // Set field level break
        $Page->GroupCounter[1] = $Page->GroupCount;
        $Page->Tahun->getCnt($Page->Tahun->Records); // Get record count
?>
<?php if ($Page->Tahun->Visible && $Page->Tahun->ShowGroupHeaderAsRow) { ?>
<?php
        // Render header row
        $Page->resetAttributes();
        $Page->RowType = RowType::TOTAL;
        $Page->RowTotalType = RowSummary::GROUP;
        $Page->RowTotalSubType = RowTotal::HEADER;
        $Page->RowGroupLevel = 1;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->Tahun->Visible) { ?>
        <td data-field="Tahun"<?= $Page->Tahun->cellAttributes("ew-rpt-grp-caret") ?>><?= $Page->Tahun->groupToggleIcon() ?></td>
<?php } ?>
        <td data-field="Tahun" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?= $Page->Tahun->cellAttributes() ?>>
            <span class="ew-summary-caption Billing_Report_Tahun"><?= $Page->renderFieldHeader($Page->Tahun) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->Tahun->viewAttributes() ?>><?= $Page->Tahun->GroupViewValue ?></span>
            <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><?= FormatNumber($Page->Tahun->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span>
        </td>
    </tr>
<?php } ?>
<?php
    $Page->Bulan->getDistinctValues($Page->Tahun->Records, $Page->Bulan->getSort());
    $Page->setGroupCount(count($Page->Bulan->DistinctValues), $Page->GroupCounter[1]);
    $Page->GroupCounter[2] = 0; // Init group count index
    foreach ($Page->Bulan->DistinctValues as $Bulan) { // Load records for this distinct value
        $Page->Bulan->setGroupValue($Bulan); // Set group value
        $Page->Bulan->getDistinctRecords($Page->Tahun->Records, $Page->Bulan->groupValue());
        $Page->Bulan->LevelBreak = true; // Set field level break
        $Page->GroupCounter[2]++;
        $Page->Bulan->getCnt($Page->Bulan->Records); // Get record count
?>
<?php if ($Page->Bulan->Visible && $Page->Bulan->ShowGroupHeaderAsRow) { ?>
<?php
        // Render header row
        $Page->Bulan->setDbValue($Bulan); // Set current value for Bulan
        $Page->resetAttributes();
        $Page->RowType = RowType::TOTAL;
        $Page->RowTotalType = RowSummary::GROUP;
        $Page->RowTotalSubType = RowTotal::HEADER;
        $Page->RowGroupLevel = 2;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->Tahun->Visible) { ?>
        <td data-field="Tahun"<?= $Page->Tahun->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Bulan->Visible) { ?>
        <td data-field="Bulan"<?= $Page->Bulan->cellAttributes("ew-rpt-grp-caret") ?>><?= $Page->Bulan->groupToggleIcon() ?></td>
<?php } ?>
        <td data-field="Bulan" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?= $Page->Bulan->cellAttributes() ?>>
            <span class="ew-summary-caption Billing_Report_Bulan"><?= $Page->renderFieldHeader($Page->Bulan) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->Bulan->viewAttributes() ?>><?= $Page->Bulan->GroupViewValue ?></span>
            <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><?= FormatNumber($Page->Bulan->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span>
        </td>
    </tr>
<?php } ?>
<?php
    $Page->Tanggal->getDistinctValues($Page->Bulan->Records, $Page->Tanggal->getSort());
    $Page->setGroupCount(count($Page->Tanggal->DistinctValues), $Page->GroupCounter[1], $Page->GroupCounter[2]);
    $Page->GroupCounter[3] = 0; // Init group count index
    foreach ($Page->Tanggal->DistinctValues as $Tanggal) { // Load records for this distinct value
        $Page->Tanggal->setGroupValue($Tanggal); // Set group value
        $Page->Tanggal->getDistinctRecords($Page->Bulan->Records, $Page->Tanggal->groupValue());
        $Page->Tanggal->LevelBreak = true; // Set field level break
        $Page->GroupCounter[3]++;
        $Page->Tanggal->getCnt($Page->Tanggal->Records); // Get record count
?>
<?php if ($Page->Tanggal->Visible && $Page->Tanggal->ShowGroupHeaderAsRow) { ?>
<?php
        // Render header row
        $Page->Tanggal->setDbValue($Tanggal); // Set current value for Tanggal
        $Page->resetAttributes();
        $Page->RowType = RowType::TOTAL;
        $Page->RowTotalType = RowSummary::GROUP;
        $Page->RowTotalSubType = RowTotal::HEADER;
        $Page->RowGroupLevel = 3;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->Tahun->Visible) { ?>
        <td data-field="Tahun"<?= $Page->Tahun->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Bulan->Visible) { ?>
        <td data-field="Bulan"<?= $Page->Bulan->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { ?>
        <td data-field="Tanggal"<?= $Page->Tanggal->cellAttributes("ew-rpt-grp-caret") ?>><?= $Page->Tanggal->groupToggleIcon() ?></td>
<?php } ?>
        <td data-field="Tanggal" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?= $Page->Tanggal->cellAttributes() ?>>
            <span class="ew-summary-caption Billing_Report_Tanggal"><?= $Page->renderFieldHeader($Page->Tanggal) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->Tanggal->viewAttributes() ?>><?= $Page->Tanggal->GroupViewValue ?></span>
            <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><?= FormatNumber($Page->Tanggal->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span>
        </td>
    </tr>
<?php } ?>
<?php
    $Page->Status->getDistinctValues($Page->Tanggal->Records, $Page->Status->getSort());
    $Page->setGroupCount(count($Page->Status->DistinctValues), $Page->GroupCounter[1], $Page->GroupCounter[2], $Page->GroupCounter[3]);
    $Page->GroupCounter[4] = 0; // Init group count index
    foreach ($Page->Status->DistinctValues as $Status) { // Load records for this distinct value
        $Page->Status->setGroupValue($Status); // Set group value
        $Page->Status->getDistinctRecords($Page->Tanggal->Records, $Page->Status->groupValue());
        $Page->Status->LevelBreak = true; // Set field level break
        $Page->GroupCounter[4]++;
        $Page->Status->getCnt($Page->Status->Records); // Get record count
        $Page->setGroupCount($Page->Status->Count, $Page->GroupCounter[1], $Page->GroupCounter[2], $Page->GroupCounter[3], $Page->GroupCounter[4]);
?>
<?php if ($Page->Status->Visible && $Page->Status->ShowGroupHeaderAsRow) { ?>
<?php
        // Render header row
        $Page->Status->setDbValue($Status); // Set current value for Status
        $Page->resetAttributes();
        $Page->RowType = RowType::TOTAL;
        $Page->RowTotalType = RowSummary::GROUP;
        $Page->RowTotalSubType = RowTotal::HEADER;
        $Page->RowGroupLevel = 4;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->Tahun->Visible) { ?>
        <td data-field="Tahun"<?= $Page->Tahun->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Bulan->Visible) { ?>
        <td data-field="Bulan"<?= $Page->Bulan->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { ?>
        <td data-field="Tanggal"<?= $Page->Tanggal->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Status->Visible) { ?>
        <td data-field="Status"<?= $Page->Status->cellAttributes("ew-rpt-grp-caret") ?>><?= $Page->Status->groupToggleIcon() ?></td>
<?php } ?>
        <td data-field="Status" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 4) ?>"<?= $Page->Status->cellAttributes() ?>>
            <span class="ew-summary-caption Billing_Report_Status"><?= $Page->renderFieldHeader($Page->Status) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->Status->viewAttributes() ?>><?= $Page->Status->GroupViewValue ?></span>
            <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><?= FormatNumber($Page->Status->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span>
        </td>
    </tr>
<?php } ?>
<?php
        $Page->RecordCount = 0; // Reset record count
        foreach ($Page->Status->Records as $record) {
            $Page->RecordCount++;
            $Page->RecordIndex++;
            $Page->loadRowValues($record);
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = RowType::DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->Tahun->Visible) { ?>
    <?php if ($Page->Tahun->ShowGroupHeaderAsRow) { ?>
        <td data-field="Tahun"<?= $Page->Tahun->cellAttributes() ?>></td>
    <?php } else { ?>
        <td data-field="Tahun"<?= $Page->Tahun->cellAttributes() ?>><span<?= $Page->Tahun->viewAttributes() ?>><?= $Page->Tahun->GroupViewValue ?></span></td>
    <?php } ?>
<?php } ?>
<?php if ($Page->Bulan->Visible) { ?>
    <?php if ($Page->Bulan->ShowGroupHeaderAsRow) { ?>
        <td data-field="Bulan"<?= $Page->Bulan->cellAttributes() ?>></td>
    <?php } else { ?>
        <td data-field="Bulan"<?= $Page->Bulan->cellAttributes() ?>><span<?= $Page->Bulan->viewAttributes() ?>><?= $Page->Bulan->GroupViewValue ?></span></td>
    <?php } ?>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { ?>
    <?php if ($Page->Tanggal->ShowGroupHeaderAsRow) { ?>
        <td data-field="Tanggal"<?= $Page->Tanggal->cellAttributes() ?>></td>
    <?php } else { ?>
        <td data-field="Tanggal"<?= $Page->Tanggal->cellAttributes() ?>><span<?= $Page->Tanggal->viewAttributes() ?>><?= $Page->Tanggal->GroupViewValue ?></span></td>
    <?php } ?>
<?php } ?>
<?php if ($Page->Status->Visible) { ?>
    <?php if ($Page->Status->ShowGroupHeaderAsRow) { ?>
        <td data-field="Status"<?= $Page->Status->cellAttributes() ?>></td>
    <?php } else { ?>
        <td data-field="Status"<?= $Page->Status->cellAttributes() ?>><span<?= $Page->Status->viewAttributes() ?>><?= $Page->Status->GroupViewValue ?></span></td>
    <?php } ?>
<?php } ?>
<?php if ($Page->NomorBC->Visible) { ?>
        <td data-field="NomorBC"<?= $Page->NomorBC->cellAttributes() ?>>
<span<?= $Page->NomorBC->viewAttributes() ?>>
<?= $Page->NomorBC->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { ?>
        <td data-field="NamaPelanggan"<?= $Page->NamaPelanggan->cellAttributes() ?>>
<span<?= $Page->NamaPelanggan->viewAttributes() ?>>
<?= $Page->NamaPelanggan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->Tagihan->Visible) { ?>
        <td data-field="Tagihan"<?= $Page->Tagihan->cellAttributes() ?>>
<span<?= $Page->Tagihan->viewAttributes() ?>>
<?= $Page->Tagihan->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
    }
    } // End group level 3
    } // End group level 2
    } // End group level 1
?>
<?php

    // Next group
    $Page->loadGroupRowValues();

    // Show header if page break
    if ($Page->isExport()) {
        $Page->ShowHeader = ($Page->ExportPageBreakCount == 0) ? false : ($Page->GroupCount % $Page->ExportPageBreakCount == 0);
    }

    // Page_Breaking server event
    if ($Page->ShowHeader) {
        $Page->pageBreaking($Page->ShowHeader, $Page->PageBreakHtml);
    }
    $Page->GroupCount++;
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = RowType::TOTAL;
    $Page->RowTotalType = RowSummary::GRAND;
    $Page->RowTotalSubType = RowTotal::FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->Tahun->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span></td></tr>
    <tr<?= $Page->rowAttributes() ?>>
<?php if ($Page->GroupColumnCount > 0) { ?>
        <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"></td>
<?php } ?>
<?php if ($Page->NomorBC->Visible) { ?>
        <td data-field="NomorBC"<?= $Page->NomorBC->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { ?>
        <td data-field="NamaPelanggan"<?= $Page->NamaPelanggan->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Tagihan->Visible) { ?>
        <td data-field="Tagihan"<?= $Page->Tagihan->cellAttributes() ?>><span class="ew-aggregate-caption"><?= $Language->phrase("RptSum") ?></span><span class="ew-aggregate-equal"><?= $Language->phrase("AggregateEqual") ?></span><span class="ew-aggregate-value"><span<?= $Page->Tagihan->viewAttributes() ?>><?= $Page->Tagihan->SumViewValue ?></span></span></td>
<?php } ?>
    </tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
    <tr<?= $Page->rowAttributes() ?>>
<?php if ($Page->GroupColumnCount > 0) { ?>
        <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?= $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Page->NomorBC->Visible) { ?>
        <td data-field="NomorBC"<?= $Page->NomorBC->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { ?>
        <td data-field="NamaPelanggan"<?= $Page->NamaPelanggan->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Tagihan->Visible) { ?>
        <td data-field="Tagihan"<?= $Page->Tagihan->cellAttributes() ?>>
<span<?= $Page->Tagihan->viewAttributes() ?>>
<?= $Page->Tagihan->SumViewValue ?></span>
</td>
<?php } ?>
    </tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Page->TotalGroups > 0) { ?>
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0) && $Page->Pager->Visible) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<?= $Page->Pager->render() ?>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</main>
<!-- /.report-summary -->
<!-- Summary report (end) -->
<?php } ?>
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
