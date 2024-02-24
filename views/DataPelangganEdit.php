<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$DataPelangganEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<?php if (!$Page->IsModal) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<form name="fdata_pelangganedit" id="fdata_pelangganedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { data_pelanggan: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fdata_pelangganedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdata_pelangganedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["NomorPelanggan", [fields.NomorPelanggan.visible && fields.NomorPelanggan.required ? ew.Validators.required(fields.NomorPelanggan.caption) : null], fields.NomorPelanggan.isInvalid],
            ["NamaPelanggan", [fields.NamaPelanggan.visible && fields.NamaPelanggan.required ? ew.Validators.required(fields.NamaPelanggan.caption) : null], fields.NamaPelanggan.isInvalid],
            ["IP", [fields.IP.visible && fields.IP.required ? ew.Validators.required(fields.IP.caption) : null], fields.IP.isInvalid],
            ["Bandwidth", [fields.Bandwidth.visible && fields.Bandwidth.required ? ew.Validators.required(fields.Bandwidth.caption) : null], fields.Bandwidth.isInvalid],
            ["Harga", [fields.Harga.visible && fields.Harga.required ? ew.Validators.required(fields.Harga.caption) : null, ew.Validators.integer], fields.Harga.isInvalid],
            ["JenisSubscription", [fields.JenisSubscription.visible && fields.JenisSubscription.required ? ew.Validators.required(fields.JenisSubscription.caption) : null], fields.JenisSubscription.isInvalid],
            ["BulanSubscription", [fields.BulanSubscription.visible && fields.BulanSubscription.required ? ew.Validators.required(fields.BulanSubscription.caption) : null], fields.BulanSubscription.isInvalid],
            ["KeteranganSubscription", [fields.KeteranganSubscription.visible && fields.KeteranganSubscription.required ? ew.Validators.required(fields.KeteranganSubscription.caption) : null], fields.KeteranganSubscription.isInvalid]
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
            "Bandwidth": <?= $Page->Bandwidth->toClientList($Page) ?>,
            "JenisSubscription": <?= $Page->JenisSubscription->toClientList($Page) ?>,
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="data_pelanggan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($Page->NomorPelanggan->Visible) { // NomorPelanggan ?>
    <div id="r_NomorPelanggan"<?= $Page->NomorPelanggan->rowAttributes() ?>>
        <label id="elh_data_pelanggan_NomorPelanggan" for="x_NomorPelanggan" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_data_pelanggan_NomorPelanggan"><?= $Page->NomorPelanggan->caption() ?><?= $Page->NomorPelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NomorPelanggan->cellAttributes() ?>>
<template id="tpx_data_pelanggan_NomorPelanggan"><span id="el_data_pelanggan_NomorPelanggan">
<span<?= $Page->NomorPelanggan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NomorPelanggan->getDisplayValue($Page->NomorPelanggan->EditValue))) ?>"></span>
<input type="hidden" data-table="data_pelanggan" data-field="x_NomorPelanggan" data-hidden="1" name="x_NomorPelanggan" id="x_NomorPelanggan" value="<?= HtmlEncode($Page->NomorPelanggan->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { // NamaPelanggan ?>
    <div id="r_NamaPelanggan"<?= $Page->NamaPelanggan->rowAttributes() ?>>
        <label id="elh_data_pelanggan_NamaPelanggan" for="x_NamaPelanggan" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_data_pelanggan_NamaPelanggan"><?= $Page->NamaPelanggan->caption() ?><?= $Page->NamaPelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NamaPelanggan->cellAttributes() ?>>
<template id="tpx_data_pelanggan_NamaPelanggan"><span id="el_data_pelanggan_NamaPelanggan">
<input type="<?= $Page->NamaPelanggan->getInputTextType() ?>" name="x_NamaPelanggan" id="x_NamaPelanggan" data-table="data_pelanggan" data-field="x_NamaPelanggan" value="<?= $Page->NamaPelanggan->EditValue ?>" size="30" maxlength="64" placeholder="<?= HtmlEncode($Page->NamaPelanggan->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->NamaPelanggan->formatPattern()) ?>"<?= $Page->NamaPelanggan->editAttributes() ?> aria-describedby="x_NamaPelanggan_help">
<?= $Page->NamaPelanggan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NamaPelanggan->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->IP->Visible) { // IP ?>
    <div id="r_IP"<?= $Page->IP->rowAttributes() ?>>
        <label id="elh_data_pelanggan_IP" for="x_IP" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_data_pelanggan_IP"><?= $Page->IP->caption() ?><?= $Page->IP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->IP->cellAttributes() ?>>
<template id="tpx_data_pelanggan_IP"><span id="el_data_pelanggan_IP">
<input type="<?= $Page->IP->getInputTextType() ?>" name="x_IP" id="x_IP" data-table="data_pelanggan" data-field="x_IP" value="<?= $Page->IP->EditValue ?>" size="30" maxlength="24" placeholder="<?= HtmlEncode($Page->IP->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->IP->formatPattern()) ?>"<?= $Page->IP->editAttributes() ?> aria-describedby="x_IP_help">
<?= $Page->IP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->IP->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Bandwidth->Visible) { // Bandwidth ?>
    <div id="r_Bandwidth"<?= $Page->Bandwidth->rowAttributes() ?>>
        <label id="elh_data_pelanggan_Bandwidth" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_data_pelanggan_Bandwidth"><?= $Page->Bandwidth->caption() ?><?= $Page->Bandwidth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Bandwidth->cellAttributes() ?>>
<template id="tpx_data_pelanggan_Bandwidth"><span id="el_data_pelanggan_Bandwidth">
<template id="tp_x_Bandwidth">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="data_pelanggan" data-field="x_Bandwidth" name="x_Bandwidth" id="x_Bandwidth"<?= $Page->Bandwidth->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_Bandwidth" class="ew-item-list"></div>
<selection-list hidden
    id="x_Bandwidth"
    name="x_Bandwidth"
    value="<?= HtmlEncode($Page->Bandwidth->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_Bandwidth"
    data-target="dsl_x_Bandwidth"
    data-repeatcolumn="2"
    class="form-control<?= $Page->Bandwidth->isInvalidClass() ?>"
    data-table="data_pelanggan"
    data-field="x_Bandwidth"
    data-value-separator="<?= $Page->Bandwidth->displayValueSeparatorAttribute() ?>"
    data-ew-action="autofill"
    <?= $Page->Bandwidth->editAttributes() ?>></selection-list>
<?= $Page->Bandwidth->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Bandwidth->getErrorMessage() ?></div>
<?= $Page->Bandwidth->Lookup->getParamTag($Page, "p_x_Bandwidth") ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Harga->Visible) { // Harga ?>
    <div id="r_Harga"<?= $Page->Harga->rowAttributes() ?>>
        <label id="elh_data_pelanggan_Harga" for="x_Harga" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_data_pelanggan_Harga"><?= $Page->Harga->caption() ?><?= $Page->Harga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Harga->cellAttributes() ?>>
<template id="tpx_data_pelanggan_Harga"><span id="el_data_pelanggan_Harga">
<input type="<?= $Page->Harga->getInputTextType() ?>" name="x_Harga" id="x_Harga" data-table="data_pelanggan" data-field="x_Harga" value="<?= $Page->Harga->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Harga->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Harga->formatPattern()) ?>"<?= $Page->Harga->editAttributes() ?> aria-describedby="x_Harga_help">
<?= $Page->Harga->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Harga->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JenisSubscription->Visible) { // JenisSubscription ?>
    <div id="r_JenisSubscription"<?= $Page->JenisSubscription->rowAttributes() ?>>
        <label id="elh_data_pelanggan_JenisSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_data_pelanggan_JenisSubscription"><?= $Page->JenisSubscription->caption() ?><?= $Page->JenisSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->JenisSubscription->cellAttributes() ?>>
<template id="tpx_data_pelanggan_JenisSubscription"><span id="el_data_pelanggan_JenisSubscription">
<template id="tp_x_JenisSubscription">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="data_pelanggan" data-field="x_JenisSubscription" name="x_JenisSubscription" id="x_JenisSubscription"<?= $Page->JenisSubscription->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_JenisSubscription" class="ew-item-list"></div>
<selection-list hidden
    id="x_JenisSubscription"
    name="x_JenisSubscription"
    value="<?= HtmlEncode($Page->JenisSubscription->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_JenisSubscription"
    data-target="dsl_x_JenisSubscription"
    data-repeatcolumn="5"
    class="form-control<?= $Page->JenisSubscription->isInvalidClass() ?>"
    data-table="data_pelanggan"
    data-field="x_JenisSubscription"
    data-value-separator="<?= $Page->JenisSubscription->displayValueSeparatorAttribute() ?>"
    data-ew-action="autofill"
    <?= $Page->JenisSubscription->editAttributes() ?>></selection-list>
<?= $Page->JenisSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->JenisSubscription->getErrorMessage() ?></div>
<?= $Page->JenisSubscription->Lookup->getParamTag($Page, "p_x_JenisSubscription") ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->BulanSubscription->Visible) { // BulanSubscription ?>
    <div id="r_BulanSubscription"<?= $Page->BulanSubscription->rowAttributes() ?>>
        <label id="elh_data_pelanggan_BulanSubscription" for="x_BulanSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_data_pelanggan_BulanSubscription"><?= $Page->BulanSubscription->caption() ?><?= $Page->BulanSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->BulanSubscription->cellAttributes() ?>>
<template id="tpx_data_pelanggan_BulanSubscription"><span id="el_data_pelanggan_BulanSubscription">
<input type="<?= $Page->BulanSubscription->getInputTextType() ?>" name="x_BulanSubscription" id="x_BulanSubscription" data-table="data_pelanggan" data-field="x_BulanSubscription" value="<?= $Page->BulanSubscription->EditValue ?>" size="30" maxlength="240" placeholder="<?= HtmlEncode($Page->BulanSubscription->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->BulanSubscription->formatPattern()) ?>"<?= $Page->BulanSubscription->editAttributes() ?> aria-describedby="x_BulanSubscription_help">
<?= $Page->BulanSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->BulanSubscription->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KeteranganSubscription->Visible) { // KeteranganSubscription ?>
    <div id="r_KeteranganSubscription"<?= $Page->KeteranganSubscription->rowAttributes() ?>>
        <label id="elh_data_pelanggan_KeteranganSubscription" for="x_KeteranganSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_data_pelanggan_KeteranganSubscription"><?= $Page->KeteranganSubscription->caption() ?><?= $Page->KeteranganSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->KeteranganSubscription->cellAttributes() ?>>
<template id="tpx_data_pelanggan_KeteranganSubscription"><span id="el_data_pelanggan_KeteranganSubscription">
<input type="<?= $Page->KeteranganSubscription->getInputTextType() ?>" name="x_KeteranganSubscription" id="x_KeteranganSubscription" data-table="data_pelanggan" data-field="x_KeteranganSubscription" value="<?= $Page->KeteranganSubscription->EditValue ?>" size="30" maxlength="240" placeholder="<?= HtmlEncode($Page->KeteranganSubscription->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->KeteranganSubscription->formatPattern()) ?>"<?= $Page->KeteranganSubscription->editAttributes() ?> aria-describedby="x_KeteranganSubscription_help">
<?= $Page->KeteranganSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KeteranganSubscription->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_data_pelangganedit" class="ew-custom-template"></div>
<template id="tpm_data_pelangganedit">
<div id="ct_DataPelangganEdit"><div class="container mt-3" style="padding-left: 0px;">
    <h2>EDIT DATA</h2>
    <div class="row mt-5">
        <div class="col-xs-12 col-sm-9 col-lg-8">
			<div class="card text-dark shadow p-3 mb-5 bg-body rounded-4 border-0">
				<div class="card-body">
					<div class="row mb-3">
						<label id="elh_data_pelanggan_NomorPelanggan" for="x_NomorPelanggan" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->NomorPelanggan->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_data_pelanggan_NomorPelanggan"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_data_pelanggan_NamaPelanggan" for="x_NamaPelanggan" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->NamaPelanggan->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_data_pelanggan_NamaPelanggan"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_data_pelanggan_IP" for="x_IP" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->IP->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_data_pelanggan_IP"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_data_pelanggan_Bandwidth" for="x_Bandwidth" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->Bandwidth->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_data_pelanggan_Bandwidth"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_data_pelanggan_Harga" for="x_Harga" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->Harga->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_data_pelanggan_Harga"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_data_pelanggan_JenisSubscription" for="x_JenisSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->JenisSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_data_pelanggan_JenisSubscription"></slot></div>
						</div>
					</div>
                    <div class="row mb-3" hidden>
						<label id="elh_data_pelanggan_BulanSubscription" for="x_BulanSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->BulanSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_data_pelanggan_BulanSubscription"></slot></div>
						</div>
					</div>
                    <div class="row mb-3" hidden>
						<label id="elh_data_pelanggan_KeteranganSubscription" for="x_KeteranganSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->KeteranganSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_data_pelanggan_KeteranganSubscription"></slot></div>
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fdata_pelangganedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fdata_pelangganedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php if (!$Page->IsModal) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_data_pelangganedit", "tpm_data_pelangganedit", "data_pelangganedit", "<?= $Page->Export ?>", "data_pelanggan", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
    loadjs.done("customtemplate");
});
</script>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("data_pelanggan");
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
