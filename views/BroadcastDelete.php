<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$BroadcastDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { broadcast: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fbroadcastdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbroadcastdelete")
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
<form name="fbroadcastdelete" id="fbroadcastdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="broadcast">
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
<?php if ($Page->NomorBC->Visible) { // NomorBC ?>
        <th class="<?= $Page->NomorBC->headerCellClass() ?>"><span id="elh_broadcast_NomorBC" class="broadcast_NomorBC"><?= $Page->NomorBC->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
        <th class="<?= $Page->Tanggal->headerCellClass() ?>"><span id="elh_broadcast_Tanggal" class="broadcast_Tanggal"><?= $Page->Tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { // NamaPelanggan ?>
        <th class="<?= $Page->NamaPelanggan->headerCellClass() ?>"><span id="elh_broadcast_NamaPelanggan" class="broadcast_NamaPelanggan"><?= $Page->NamaPelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->IP->Visible) { // IP ?>
        <th class="<?= $Page->IP->headerCellClass() ?>"><span id="elh_broadcast_IP" class="broadcast_IP"><?= $Page->IP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Bandwidth->Visible) { // Bandwidth ?>
        <th class="<?= $Page->Bandwidth->headerCellClass() ?>"><span id="elh_broadcast_Bandwidth" class="broadcast_Bandwidth"><?= $Page->Bandwidth->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Tagihan->Visible) { // Tagihan ?>
        <th class="<?= $Page->Tagihan->headerCellClass() ?>"><span id="elh_broadcast_Tagihan" class="broadcast_Tagihan"><?= $Page->Tagihan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Status->Visible) { // Status ?>
        <th class="<?= $Page->Status->headerCellClass() ?>"><span id="elh_broadcast_Status" class="broadcast_Status"><?= $Page->Status->caption() ?></span></th>
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
<?php if ($Page->NomorBC->Visible) { // NomorBC ?>
        <td<?= $Page->NomorBC->cellAttributes() ?>>
<span id="">
<span<?= $Page->NomorBC->viewAttributes() ?>>
<?= $Page->NomorBC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
        <td<?= $Page->Tanggal->cellAttributes() ?>>
<span id="">
<span<?= $Page->Tanggal->viewAttributes() ?>>
<?= $Page->Tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { // NamaPelanggan ?>
        <td<?= $Page->NamaPelanggan->cellAttributes() ?>>
<span id="">
<span<?= $Page->NamaPelanggan->viewAttributes() ?>>
<?= $Page->NamaPelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->IP->Visible) { // IP ?>
        <td<?= $Page->IP->cellAttributes() ?>>
<span id="">
<span<?= $Page->IP->viewAttributes() ?>>
<?= $Page->IP->getViewValue() ?></span>
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
<?php if ($Page->Tagihan->Visible) { // Tagihan ?>
        <td<?= $Page->Tagihan->cellAttributes() ?>>
<span id="">
<span<?= $Page->Tagihan->viewAttributes() ?>>
<?= $Page->Tagihan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Status->Visible) { // Status ?>
        <td<?= $Page->Status->cellAttributes() ?>>
<span id="">
<span<?= $Page->Status->viewAttributes() ?>>
<?= $Page->Status->getViewValue() ?></span>
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
