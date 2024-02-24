<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$BandwidthView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<?php } ?>
<form name="fbandwidthview" id="fbandwidthview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bandwidth: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fbandwidthview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbandwidthview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bandwidth">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->NomorBandwidth->Visible) { // NomorBandwidth ?>
    <tr id="r_NomorBandwidth"<?= $Page->NomorBandwidth->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bandwidth_NomorBandwidth"><?= $Page->NomorBandwidth->caption() ?></span></td>
        <td data-name="NomorBandwidth"<?= $Page->NomorBandwidth->cellAttributes() ?>>
<span id="el_bandwidth_NomorBandwidth">
<span<?= $Page->NomorBandwidth->viewAttributes() ?>>
<?= $Page->NomorBandwidth->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Bandwidth->Visible) { // Bandwidth ?>
    <tr id="r_Bandwidth"<?= $Page->Bandwidth->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bandwidth_Bandwidth"><?= $Page->Bandwidth->caption() ?></span></td>
        <td data-name="Bandwidth"<?= $Page->Bandwidth->cellAttributes() ?>>
<span id="el_bandwidth_Bandwidth">
<span<?= $Page->Bandwidth->viewAttributes() ?>>
<?= $Page->Bandwidth->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Harga->Visible) { // Harga ?>
    <tr id="r_Harga"<?= $Page->Harga->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bandwidth_Harga"><?= $Page->Harga->caption() ?></span></td>
        <td data-name="Harga"<?= $Page->Harga->cellAttributes() ?>>
<span id="el_bandwidth_Harga">
<span<?= $Page->Harga->viewAttributes() ?>>
<?= $Page->Harga->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<?php } ?>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
