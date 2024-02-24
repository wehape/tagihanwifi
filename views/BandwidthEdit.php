<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$BandwidthEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<?php if (!$Page->IsModal) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<form name="fbandwidthedit" id="fbandwidthedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bandwidth: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fbandwidthedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbandwidthedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["NomorBandwidth", [fields.NomorBandwidth.visible && fields.NomorBandwidth.required ? ew.Validators.required(fields.NomorBandwidth.caption) : null], fields.NomorBandwidth.isInvalid],
            ["Bandwidth", [fields.Bandwidth.visible && fields.Bandwidth.required ? ew.Validators.required(fields.Bandwidth.caption) : null], fields.Bandwidth.isInvalid],
            ["Harga", [fields.Harga.visible && fields.Harga.required ? ew.Validators.required(fields.Harga.caption) : null, ew.Validators.integer], fields.Harga.isInvalid]
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
<input type="hidden" name="t" value="bandwidth">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($Page->NomorBandwidth->Visible) { // NomorBandwidth ?>
    <div id="r_NomorBandwidth"<?= $Page->NomorBandwidth->rowAttributes() ?>>
        <label id="elh_bandwidth_NomorBandwidth" for="x_NomorBandwidth" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bandwidth_NomorBandwidth"><?= $Page->NomorBandwidth->caption() ?><?= $Page->NomorBandwidth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NomorBandwidth->cellAttributes() ?>>
<template id="tpx_bandwidth_NomorBandwidth"><span id="el_bandwidth_NomorBandwidth">
<span<?= $Page->NomorBandwidth->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NomorBandwidth->getDisplayValue($Page->NomorBandwidth->EditValue))) ?>"></span>
<input type="hidden" data-table="bandwidth" data-field="x_NomorBandwidth" data-hidden="1" name="x_NomorBandwidth" id="x_NomorBandwidth" value="<?= HtmlEncode($Page->NomorBandwidth->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Bandwidth->Visible) { // Bandwidth ?>
    <div id="r_Bandwidth"<?= $Page->Bandwidth->rowAttributes() ?>>
        <label id="elh_bandwidth_Bandwidth" for="x_Bandwidth" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bandwidth_Bandwidth"><?= $Page->Bandwidth->caption() ?><?= $Page->Bandwidth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Bandwidth->cellAttributes() ?>>
<template id="tpx_bandwidth_Bandwidth"><span id="el_bandwidth_Bandwidth">
<input type="<?= $Page->Bandwidth->getInputTextType() ?>" name="x_Bandwidth" id="x_Bandwidth" data-table="bandwidth" data-field="x_Bandwidth" value="<?= $Page->Bandwidth->EditValue ?>" size="30" maxlength="24" placeholder="<?= HtmlEncode($Page->Bandwidth->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Bandwidth->formatPattern()) ?>"<?= $Page->Bandwidth->editAttributes() ?> aria-describedby="x_Bandwidth_help">
<?= $Page->Bandwidth->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Bandwidth->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Harga->Visible) { // Harga ?>
    <div id="r_Harga"<?= $Page->Harga->rowAttributes() ?>>
        <label id="elh_bandwidth_Harga" for="x_Harga" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bandwidth_Harga"><?= $Page->Harga->caption() ?><?= $Page->Harga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Harga->cellAttributes() ?>>
<template id="tpx_bandwidth_Harga"><span id="el_bandwidth_Harga">
<input type="<?= $Page->Harga->getInputTextType() ?>" name="x_Harga" id="x_Harga" data-table="bandwidth" data-field="x_Harga" value="<?= $Page->Harga->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Harga->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Harga->formatPattern()) ?>"<?= $Page->Harga->editAttributes() ?> aria-describedby="x_Harga_help">
<?= $Page->Harga->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Harga->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_bandwidthedit" class="ew-custom-template"></div>
<template id="tpm_bandwidthedit">
<div id="ct_BandwidthEdit"><div class="container mt-3" style="padding-left: 0px;">
    <h2>EDIT PAKET</h2>
    <div class="row mt-5">
        <div class="col-xs-12 col-sm-9 col-lg-8">
			<div class="card text-dark shadow p-3 mb-5 bg-body rounded-4 border-0">
				<div class="card-body">
					<div class="row mb-3">
						<label id="elh_bandwidth_NomorBandwidth" for="x_NomorBandwidth" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->NomorBandwidth->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_bandwidth_NomorBandwidth"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_bandwidth_NamaPelanggan" for="x_Bandwidth" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->Bandwidth->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_bandwidth_Bandwidth"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_bandwidth_Harga" for="x_Harga" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->Harga->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_bandwidth_Harga"></slot></div>
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fbandwidthedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fbandwidthedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.applyTemplate("tpd_bandwidthedit", "tpm_bandwidthedit", "bandwidthedit", "<?= $Page->Export ?>", "bandwidth", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
    ew.addEventHandlers("bandwidth");
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
