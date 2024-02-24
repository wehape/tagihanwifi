<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$SubscriptionView = &$Page;
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
<form name="fsubscriptionview" id="fsubscriptionview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { subscription: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fsubscriptionview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsubscriptionview")
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
<input type="hidden" name="t" value="subscription">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->NomorSubscription->Visible) { // NomorSubscription ?>
    <tr id="r_NomorSubscription"<?= $Page->NomorSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subscription_NomorSubscription"><?= $Page->NomorSubscription->caption() ?></span></td>
        <td data-name="NomorSubscription"<?= $Page->NomorSubscription->cellAttributes() ?>>
<span id="el_subscription_NomorSubscription">
<span<?= $Page->NomorSubscription->viewAttributes() ?>>
<?= $Page->NomorSubscription->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->JenisSubscription->Visible) { // JenisSubscription ?>
    <tr id="r_JenisSubscription"<?= $Page->JenisSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subscription_JenisSubscription"><?= $Page->JenisSubscription->caption() ?></span></td>
        <td data-name="JenisSubscription"<?= $Page->JenisSubscription->cellAttributes() ?>>
<span id="el_subscription_JenisSubscription">
<span<?= $Page->JenisSubscription->viewAttributes() ?>>
<?= $Page->JenisSubscription->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BulanSubscription->Visible) { // BulanSubscription ?>
    <tr id="r_BulanSubscription"<?= $Page->BulanSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subscription_BulanSubscription"><?= $Page->BulanSubscription->caption() ?></span></td>
        <td data-name="BulanSubscription"<?= $Page->BulanSubscription->cellAttributes() ?>>
<span id="el_subscription_BulanSubscription">
<span<?= $Page->BulanSubscription->viewAttributes() ?>>
<?= $Page->BulanSubscription->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KeteranganSubscription->Visible) { // KeteranganSubscription ?>
    <tr id="r_KeteranganSubscription"<?= $Page->KeteranganSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_subscription_KeteranganSubscription"><?= $Page->KeteranganSubscription->caption() ?></span></td>
        <td data-name="KeteranganSubscription"<?= $Page->KeteranganSubscription->cellAttributes() ?>>
<span id="el_subscription_KeteranganSubscription">
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
