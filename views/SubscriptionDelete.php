<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$SubscriptionDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { subscription: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fsubscriptiondelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsubscriptiondelete")
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
<form name="fsubscriptiondelete" id="fsubscriptiondelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="subscription">
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
<?php if ($Page->NomorSubscription->Visible) { // NomorSubscription ?>
        <th class="<?= $Page->NomorSubscription->headerCellClass() ?>"><span id="elh_subscription_NomorSubscription" class="subscription_NomorSubscription"><?= $Page->NomorSubscription->caption() ?></span></th>
<?php } ?>
<?php if ($Page->JenisSubscription->Visible) { // JenisSubscription ?>
        <th class="<?= $Page->JenisSubscription->headerCellClass() ?>"><span id="elh_subscription_JenisSubscription" class="subscription_JenisSubscription"><?= $Page->JenisSubscription->caption() ?></span></th>
<?php } ?>
<?php if ($Page->BulanSubscription->Visible) { // BulanSubscription ?>
        <th class="<?= $Page->BulanSubscription->headerCellClass() ?>"><span id="elh_subscription_BulanSubscription" class="subscription_BulanSubscription"><?= $Page->BulanSubscription->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KeteranganSubscription->Visible) { // KeteranganSubscription ?>
        <th class="<?= $Page->KeteranganSubscription->headerCellClass() ?>"><span id="elh_subscription_KeteranganSubscription" class="subscription_KeteranganSubscription"><?= $Page->KeteranganSubscription->caption() ?></span></th>
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
<?php if ($Page->NomorSubscription->Visible) { // NomorSubscription ?>
        <td<?= $Page->NomorSubscription->cellAttributes() ?>>
<span id="">
<span<?= $Page->NomorSubscription->viewAttributes() ?>>
<?= $Page->NomorSubscription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->JenisSubscription->Visible) { // JenisSubscription ?>
        <td<?= $Page->JenisSubscription->cellAttributes() ?>>
<span id="">
<span<?= $Page->JenisSubscription->viewAttributes() ?>>
<?= $Page->JenisSubscription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->BulanSubscription->Visible) { // BulanSubscription ?>
        <td<?= $Page->BulanSubscription->cellAttributes() ?>>
<span id="">
<span<?= $Page->BulanSubscription->viewAttributes() ?>>
<?= $Page->BulanSubscription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KeteranganSubscription->Visible) { // KeteranganSubscription ?>
        <td<?= $Page->KeteranganSubscription->cellAttributes() ?>>
<span id="">
<span<?= $Page->KeteranganSubscription->viewAttributes() ?>>
<?= $Page->KeteranganSubscription->getViewValue() ?></span>
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
