<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$DataPelangganView = &$Page;
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
<form name="fdata_pelangganview" id="fdata_pelangganview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { data_pelanggan: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fdata_pelangganview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdata_pelangganview")
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
<input type="hidden" name="t" value="data_pelanggan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->NomorPelanggan->Visible) { // NomorPelanggan ?>
    <tr id="r_NomorPelanggan"<?= $Page->NomorPelanggan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_pelanggan_NomorPelanggan"><?= $Page->NomorPelanggan->caption() ?></span></td>
        <td data-name="NomorPelanggan"<?= $Page->NomorPelanggan->cellAttributes() ?>>
<span id="el_data_pelanggan_NomorPelanggan">
<span<?= $Page->NomorPelanggan->viewAttributes() ?>>
<?= $Page->NomorPelanggan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { // NamaPelanggan ?>
    <tr id="r_NamaPelanggan"<?= $Page->NamaPelanggan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_pelanggan_NamaPelanggan"><?= $Page->NamaPelanggan->caption() ?></span></td>
        <td data-name="NamaPelanggan"<?= $Page->NamaPelanggan->cellAttributes() ?>>
<span id="el_data_pelanggan_NamaPelanggan">
<span<?= $Page->NamaPelanggan->viewAttributes() ?>>
<?= $Page->NamaPelanggan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->IP->Visible) { // IP ?>
    <tr id="r_IP"<?= $Page->IP->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_pelanggan_IP"><?= $Page->IP->caption() ?></span></td>
        <td data-name="IP"<?= $Page->IP->cellAttributes() ?>>
<span id="el_data_pelanggan_IP">
<span<?= $Page->IP->viewAttributes() ?>>
<?= $Page->IP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Bandwidth->Visible) { // Bandwidth ?>
    <tr id="r_Bandwidth"<?= $Page->Bandwidth->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_pelanggan_Bandwidth"><?= $Page->Bandwidth->caption() ?></span></td>
        <td data-name="Bandwidth"<?= $Page->Bandwidth->cellAttributes() ?>>
<span id="el_data_pelanggan_Bandwidth">
<span<?= $Page->Bandwidth->viewAttributes() ?>>
<?= $Page->Bandwidth->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Harga->Visible) { // Harga ?>
    <tr id="r_Harga"<?= $Page->Harga->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_pelanggan_Harga"><?= $Page->Harga->caption() ?></span></td>
        <td data-name="Harga"<?= $Page->Harga->cellAttributes() ?>>
<span id="el_data_pelanggan_Harga">
<span<?= $Page->Harga->viewAttributes() ?>>
<?= $Page->Harga->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->JenisSubscription->Visible) { // JenisSubscription ?>
    <tr id="r_JenisSubscription"<?= $Page->JenisSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_pelanggan_JenisSubscription"><?= $Page->JenisSubscription->caption() ?></span></td>
        <td data-name="JenisSubscription"<?= $Page->JenisSubscription->cellAttributes() ?>>
<span id="el_data_pelanggan_JenisSubscription">
<span<?= $Page->JenisSubscription->viewAttributes() ?>>
<?= $Page->JenisSubscription->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BulanSubscription->Visible) { // BulanSubscription ?>
    <tr id="r_BulanSubscription"<?= $Page->BulanSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_pelanggan_BulanSubscription"><?= $Page->BulanSubscription->caption() ?></span></td>
        <td data-name="BulanSubscription"<?= $Page->BulanSubscription->cellAttributes() ?>>
<span id="el_data_pelanggan_BulanSubscription">
<span<?= $Page->BulanSubscription->viewAttributes() ?>>
<?= $Page->BulanSubscription->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KeteranganSubscription->Visible) { // KeteranganSubscription ?>
    <tr id="r_KeteranganSubscription"<?= $Page->KeteranganSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_data_pelanggan_KeteranganSubscription"><?= $Page->KeteranganSubscription->caption() ?></span></td>
        <td data-name="KeteranganSubscription"<?= $Page->KeteranganSubscription->cellAttributes() ?>>
<span id="el_data_pelanggan_KeteranganSubscription">
<span<?= $Page->KeteranganSubscription->viewAttributes() ?>>
<?= $Page->KeteranganSubscription->getViewValue() ?></span>
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
