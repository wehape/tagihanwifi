<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$BroadcastAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { broadcast: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fbroadcastadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbroadcastadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["NomorBC", [fields.NomorBC.visible && fields.NomorBC.required ? ew.Validators.required(fields.NomorBC.caption) : null], fields.NomorBC.isInvalid],
            ["Tahun", [fields.Tahun.visible && fields.Tahun.required ? ew.Validators.required(fields.Tahun.caption) : null], fields.Tahun.isInvalid],
            ["Bulan", [fields.Bulan.visible && fields.Bulan.required ? ew.Validators.required(fields.Bulan.caption) : null], fields.Bulan.isInvalid],
            ["Tanggal", [fields.Tanggal.visible && fields.Tanggal.required ? ew.Validators.required(fields.Tanggal.caption) : null], fields.Tanggal.isInvalid],
            ["NamaPelanggan", [fields.NamaPelanggan.visible && fields.NamaPelanggan.required ? ew.Validators.required(fields.NamaPelanggan.caption) : null], fields.NamaPelanggan.isInvalid],
            ["IP", [fields.IP.visible && fields.IP.required ? ew.Validators.required(fields.IP.caption) : null], fields.IP.isInvalid],
            ["Bandwidth", [fields.Bandwidth.visible && fields.Bandwidth.required ? ew.Validators.required(fields.Bandwidth.caption) : null], fields.Bandwidth.isInvalid],
            ["Tagihan", [fields.Tagihan.visible && fields.Tagihan.required ? ew.Validators.required(fields.Tagihan.caption) : null, ew.Validators.integer], fields.Tagihan.isInvalid],
            ["JenisSubscription", [fields.JenisSubscription.visible && fields.JenisSubscription.required ? ew.Validators.required(fields.JenisSubscription.caption) : null], fields.JenisSubscription.isInvalid],
            ["BulanSubscription", [fields.BulanSubscription.visible && fields.BulanSubscription.required ? ew.Validators.required(fields.BulanSubscription.caption) : null], fields.BulanSubscription.isInvalid],
            ["KeteranganSubscription", [fields.KeteranganSubscription.visible && fields.KeteranganSubscription.required ? ew.Validators.required(fields.KeteranganSubscription.caption) : null], fields.KeteranganSubscription.isInvalid],
            ["Status", [fields.Status.visible && fields.Status.required ? ew.Validators.required(fields.Status.caption) : null], fields.Status.isInvalid],
            ["Nilai", [fields.Nilai.visible && fields.Nilai.required ? ew.Validators.required(fields.Nilai.caption) : null, ew.Validators.integer], fields.Nilai.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
            "NamaPelanggan": <?= $Page->NamaPelanggan->toClientList($Page) ?>,
            "Status": <?= $Page->Status->toClientList($Page) ?>,
        })
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
<form name="fbroadcastadd" id="fbroadcastadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="broadcast">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->NomorBC->Visible) { // NomorBC ?>
    <div id="r_NomorBC"<?= $Page->NomorBC->rowAttributes() ?>>
        <label id="elh_broadcast_NomorBC" for="x_NomorBC" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_NomorBC"><?= $Page->NomorBC->caption() ?><?= $Page->NomorBC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NomorBC->cellAttributes() ?>>
<template id="tpx_broadcast_NomorBC"><span id="el_broadcast_NomorBC">
<input type="<?= $Page->NomorBC->getInputTextType() ?>" name="x_NomorBC" id="x_NomorBC" data-table="broadcast" data-field="x_NomorBC" value="<?= $Page->NomorBC->EditValue ?>" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->NomorBC->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->NomorBC->formatPattern()) ?>"<?= $Page->NomorBC->editAttributes() ?> aria-describedby="x_NomorBC_help">
<?= $Page->NomorBC->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NomorBC->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
    <div id="r_Tanggal"<?= $Page->Tanggal->rowAttributes() ?>>
        <label id="elh_broadcast_Tanggal" for="x_Tanggal" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_Tanggal"><?= $Page->Tanggal->caption() ?><?= $Page->Tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Tanggal->cellAttributes() ?>>
<template id="tpx_broadcast_Tanggal"><span id="el_broadcast_Tanggal">
<input type="<?= $Page->Tanggal->getInputTextType() ?>" name="x_Tanggal" id="x_Tanggal" data-table="broadcast" data-field="x_Tanggal" value="<?= $Page->Tanggal->EditValue ?>" maxlength="24" placeholder="<?= HtmlEncode($Page->Tanggal->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Tanggal->formatPattern()) ?>"<?= $Page->Tanggal->editAttributes() ?> aria-describedby="x_Tanggal_help">
<?= $Page->Tanggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Tanggal->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { // NamaPelanggan ?>
    <div id="r_NamaPelanggan"<?= $Page->NamaPelanggan->rowAttributes() ?>>
        <label id="elh_broadcast_NamaPelanggan" for="x_NamaPelanggan" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_NamaPelanggan"><?= $Page->NamaPelanggan->caption() ?><?= $Page->NamaPelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NamaPelanggan->cellAttributes() ?>>
<template id="tpx_broadcast_NamaPelanggan"><span id="el_broadcast_NamaPelanggan">
    <select
        id="x_NamaPelanggan"
        name="x_NamaPelanggan"
        class="form-select ew-select<?= $Page->NamaPelanggan->isInvalidClass() ?>"
        <?php if (!$Page->NamaPelanggan->IsNativeSelect) { ?>
        data-select2-id="fbroadcastadd_x_NamaPelanggan"
        <?php } ?>
        data-table="broadcast"
        data-field="x_NamaPelanggan"
        data-value-separator="<?= $Page->NamaPelanggan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->NamaPelanggan->getPlaceHolder()) ?>"
        data-ew-action="autofill"
        <?= $Page->NamaPelanggan->editAttributes() ?>>
        <?= $Page->NamaPelanggan->selectOptionListHtml("x_NamaPelanggan") ?>
    </select>
    <?= $Page->NamaPelanggan->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->NamaPelanggan->getErrorMessage() ?></div>
<?= $Page->NamaPelanggan->Lookup->getParamTag($Page, "p_x_NamaPelanggan") ?>
<?php if (!$Page->NamaPelanggan->IsNativeSelect) { ?>
<script>
loadjs.ready("fbroadcastadd", function() {
    var options = { name: "x_NamaPelanggan", selectId: "fbroadcastadd_x_NamaPelanggan" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fbroadcastadd.lists.NamaPelanggan?.lookupOptions.length) {
        options.data = { id: "x_NamaPelanggan", form: "fbroadcastadd" };
    } else {
        options.ajax = { id: "x_NamaPelanggan", form: "fbroadcastadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.broadcast.fields.NamaPelanggan.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->IP->Visible) { // IP ?>
    <div id="r_IP"<?= $Page->IP->rowAttributes() ?>>
        <label id="elh_broadcast_IP" for="x_IP" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_IP"><?= $Page->IP->caption() ?><?= $Page->IP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->IP->cellAttributes() ?>>
<template id="tpx_broadcast_IP"><span id="el_broadcast_IP">
<input type="<?= $Page->IP->getInputTextType() ?>" name="x_IP" id="x_IP" data-table="broadcast" data-field="x_IP" value="<?= $Page->IP->EditValue ?>" size="30" maxlength="24" placeholder="<?= HtmlEncode($Page->IP->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->IP->formatPattern()) ?>"<?= $Page->IP->editAttributes() ?> aria-describedby="x_IP_help">
<?= $Page->IP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->IP->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Bandwidth->Visible) { // Bandwidth ?>
    <div id="r_Bandwidth"<?= $Page->Bandwidth->rowAttributes() ?>>
        <label id="elh_broadcast_Bandwidth" for="x_Bandwidth" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_Bandwidth"><?= $Page->Bandwidth->caption() ?><?= $Page->Bandwidth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Bandwidth->cellAttributes() ?>>
<template id="tpx_broadcast_Bandwidth"><span id="el_broadcast_Bandwidth">
<input type="<?= $Page->Bandwidth->getInputTextType() ?>" name="x_Bandwidth" id="x_Bandwidth" data-table="broadcast" data-field="x_Bandwidth" value="<?= $Page->Bandwidth->EditValue ?>" size="30" maxlength="24" placeholder="<?= HtmlEncode($Page->Bandwidth->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Bandwidth->formatPattern()) ?>"<?= $Page->Bandwidth->editAttributes() ?> aria-describedby="x_Bandwidth_help">
<?= $Page->Bandwidth->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Bandwidth->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Tagihan->Visible) { // Tagihan ?>
    <div id="r_Tagihan"<?= $Page->Tagihan->rowAttributes() ?>>
        <label id="elh_broadcast_Tagihan" for="x_Tagihan" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_Tagihan"><?= $Page->Tagihan->caption() ?><?= $Page->Tagihan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Tagihan->cellAttributes() ?>>
<template id="tpx_broadcast_Tagihan"><span id="el_broadcast_Tagihan">
<input type="<?= $Page->Tagihan->getInputTextType() ?>" name="x_Tagihan" id="x_Tagihan" data-table="broadcast" data-field="x_Tagihan" value="<?= $Page->Tagihan->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Tagihan->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Tagihan->formatPattern()) ?>"<?= $Page->Tagihan->editAttributes() ?> aria-describedby="x_Tagihan_help">
<?= $Page->Tagihan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Tagihan->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JenisSubscription->Visible) { // JenisSubscription ?>
    <div id="r_JenisSubscription"<?= $Page->JenisSubscription->rowAttributes() ?>>
        <label id="elh_broadcast_JenisSubscription" for="x_JenisSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_JenisSubscription"><?= $Page->JenisSubscription->caption() ?><?= $Page->JenisSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->JenisSubscription->cellAttributes() ?>>
<template id="tpx_broadcast_JenisSubscription"><span id="el_broadcast_JenisSubscription">
<input type="<?= $Page->JenisSubscription->getInputTextType() ?>" name="x_JenisSubscription" id="x_JenisSubscription" data-table="broadcast" data-field="x_JenisSubscription" value="<?= $Page->JenisSubscription->EditValue ?>" size="30" maxlength="240" placeholder="<?= HtmlEncode($Page->JenisSubscription->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->JenisSubscription->formatPattern()) ?>"<?= $Page->JenisSubscription->editAttributes() ?> aria-describedby="x_JenisSubscription_help">
<?= $Page->JenisSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->JenisSubscription->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->BulanSubscription->Visible) { // BulanSubscription ?>
    <div id="r_BulanSubscription"<?= $Page->BulanSubscription->rowAttributes() ?>>
        <label id="elh_broadcast_BulanSubscription" for="x_BulanSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_BulanSubscription"><?= $Page->BulanSubscription->caption() ?><?= $Page->BulanSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->BulanSubscription->cellAttributes() ?>>
<template id="tpx_broadcast_BulanSubscription"><span id="el_broadcast_BulanSubscription">
<input type="<?= $Page->BulanSubscription->getInputTextType() ?>" name="x_BulanSubscription" id="x_BulanSubscription" data-table="broadcast" data-field="x_BulanSubscription" value="<?= $Page->BulanSubscription->EditValue ?>" size="30" maxlength="240" placeholder="<?= HtmlEncode($Page->BulanSubscription->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->BulanSubscription->formatPattern()) ?>"<?= $Page->BulanSubscription->editAttributes() ?> aria-describedby="x_BulanSubscription_help">
<?= $Page->BulanSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->BulanSubscription->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KeteranganSubscription->Visible) { // KeteranganSubscription ?>
    <div id="r_KeteranganSubscription"<?= $Page->KeteranganSubscription->rowAttributes() ?>>
        <label id="elh_broadcast_KeteranganSubscription" for="x_KeteranganSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_KeteranganSubscription"><?= $Page->KeteranganSubscription->caption() ?><?= $Page->KeteranganSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->KeteranganSubscription->cellAttributes() ?>>
<template id="tpx_broadcast_KeteranganSubscription"><span id="el_broadcast_KeteranganSubscription">
<input type="<?= $Page->KeteranganSubscription->getInputTextType() ?>" name="x_KeteranganSubscription" id="x_KeteranganSubscription" data-table="broadcast" data-field="x_KeteranganSubscription" value="<?= $Page->KeteranganSubscription->EditValue ?>" size="30" maxlength="240" placeholder="<?= HtmlEncode($Page->KeteranganSubscription->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->KeteranganSubscription->formatPattern()) ?>"<?= $Page->KeteranganSubscription->editAttributes() ?> aria-describedby="x_KeteranganSubscription_help">
<?= $Page->KeteranganSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KeteranganSubscription->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Status->Visible) { // Status ?>
    <div id="r_Status"<?= $Page->Status->rowAttributes() ?>>
        <label id="elh_broadcast_Status" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_Status"><?= $Page->Status->caption() ?><?= $Page->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Status->cellAttributes() ?>>
<template id="tpx_broadcast_Status"><span id="el_broadcast_Status">
<template id="tp_x_Status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="broadcast" data-field="x_Status" name="x_Status" id="x_Status"<?= $Page->Status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_Status" class="ew-item-list"></div>
<selection-list hidden
    id="x_Status"
    name="x_Status"
    value="<?= HtmlEncode($Page->Status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_Status"
    data-target="dsl_x_Status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->Status->isInvalidClass() ?>"
    data-table="broadcast"
    data-field="x_Status"
    data-value-separator="<?= $Page->Status->displayValueSeparatorAttribute() ?>"
    data-ew-action="autofill"
    <?= $Page->Status->editAttributes() ?>></selection-list>
<?= $Page->Status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Status->getErrorMessage() ?></div>
<?= $Page->Status->Lookup->getParamTag($Page, "p_x_Status") ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nilai->Visible) { // Nilai ?>
    <div id="r_Nilai"<?= $Page->Nilai->rowAttributes() ?>>
        <label id="elh_broadcast_Nilai" for="x_Nilai" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_broadcast_Nilai"><?= $Page->Nilai->caption() ?><?= $Page->Nilai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Nilai->cellAttributes() ?>>
<template id="tpx_broadcast_Nilai"><span id="el_broadcast_Nilai">
<input type="<?= $Page->Nilai->getInputTextType() ?>" name="x_Nilai" id="x_Nilai" data-table="broadcast" data-field="x_Nilai" value="<?= $Page->Nilai->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Nilai->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Nilai->formatPattern()) ?>"<?= $Page->Nilai->editAttributes() ?> aria-describedby="x_Nilai_help">
<?= $Page->Nilai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nilai->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_broadcastadd" class="ew-custom-template"></div>
<template id="tpm_broadcastadd">
<div id="ct_BroadcastAdd"><div class="container mt-3" style="padding-left: 0px;">
    <h2>INPUT BROADCAST</h2>
    <div class="row mt-5">
        <div class="col-xs-12 col-sm-9 col-lg-8">
			<div class="card text-dark shadow p-3 mb-5 bg-body rounded-4 border-0">
				<div class="card-body">
					<div class="row mb-3">
						<label id="elh_broadcast_NomorBC" for="x_NomorBC" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->NomorBC->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_broadcast_NomorBC"></slot></div>
						</div>
					</div>
					<div class="row mb-3">
						<label id="elh_broadcast_Tanggal" for="x_Tanggal" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->Tanggal->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_broadcast_Tanggal"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_broadcast_NamaPelanggan" for="x_NamaPelanggan" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->NamaPelanggan->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_broadcast_NamaPelanggan"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_broadcastn_IP" for="x_IP" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->IP->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_broadcast_IP"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_broadcast_Bandwidth" for="x_Bandwidth" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->Bandwidth->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_broadcast_Bandwidth"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_broadcast_Tagihan" for="x_Tagihan" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->Tagihan->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_broadcast_Tagihan"></slot></div>
						</div>
					</div>
                    <div class="row mb-3" hidden>
						<label id="elh_broadcast_JenisSubscription" for="x_JenisSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->JenisSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_broadcast_JenisSubscription"></slot></div>
						</div>
					</div>
                    <div class="row mb-3" hidden>
						<label id="elh_broadcast_BulanSubscription" for="x_BulanSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->BulanSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_broadcast_BulanSubscription"></slot></div>
						</div>
					</div>
                    <div class="row mb-3" hidden>
						<label id="elh_broadcast_KeteranganSubscription" for="x_KeteranganSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->KeteranganSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_broadcast_KeteranganSubscription"></slot></div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>  
</div></div>
</template>
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fbroadcastadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fbroadcastadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_broadcastadd", "tpm_broadcastadd", "broadcastadd", "<?= $Page->Export ?>", "broadcast", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
    loadjs.done("customtemplate");
});
</script>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("broadcast");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    $(document).ready(function() {
    	$("div.col-sm-10.offset-sm-2").removeClass("offset-sm-2");
    	$("div.col-sm-10").addClass("offset-xs-3 offset-sm-3 offset-lg-3");
        $("div.col-sm-10.offset-xs-3.offset-sm-3.offset-lg-3").removeClass("col-sm-10");
        $("div.offset-xs-3.offset-sm-3.offset-lg-3").addClass("col-sm-12");
    });
});
</script>
