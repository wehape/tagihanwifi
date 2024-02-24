<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$BandwidthDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bandwidth: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fbandwidthdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbandwidthdelete")
        .setPageId("delete")
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbandwidthdelete" id="fbandwidthdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bandwidth">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->NomorBandwidth->Visible) { // NomorBandwidth ?>
        <th class="<?= $Page->NomorBandwidth->headerCellClass() ?>"><span id="elh_bandwidth_NomorBandwidth" class="bandwidth_NomorBandwidth"><?= $Page->NomorBandwidth->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Bandwidth->Visible) { // Bandwidth ?>
        <th class="<?= $Page->Bandwidth->headerCellClass() ?>"><span id="elh_bandwidth_Bandwidth" class="bandwidth_Bandwidth"><?= $Page->Bandwidth->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Harga->Visible) { // Harga ?>
        <th class="<?= $Page->Harga->headerCellClass() ?>"><span id="elh_bandwidth_Harga" class="bandwidth_Harga"><?= $Page->Harga->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->NomorBandwidth->Visible) { // NomorBandwidth ?>
        <td<?= $Page->NomorBandwidth->cellAttributes() ?>>
<span id="">
<span<?= $Page->NomorBandwidth->viewAttributes() ?>>
<?= $Page->NomorBandwidth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Bandwidth->Visible) { // Bandwidth ?>
        <td<?= $Page->Bandwidth->cellAttributes() ?>>
<span id="">
<span<?= $Page->Bandwidth->viewAttributes() ?>>
<?= $Page->Bandwidth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Harga->Visible) { // Harga ?>
        <td<?= $Page->Harga->cellAttributes() ?>>
<span id="">
<span<?= $Page->Harga->viewAttributes() ?>>
<?= $Page->Harga->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Recordset?->free();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
