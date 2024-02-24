<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$StatusAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { status: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fstatusadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fstatusadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["NomorStatus", [fields.NomorStatus.visible && fields.NomorStatus.required ? ew.Validators.required(fields.NomorStatus.caption) : null], fields.NomorStatus.isInvalid],
            ["Status", [fields.Status.visible && fields.Status.required ? ew.Validators.required(fields.Status.caption) : null], fields.Status.isInvalid],
            ["Nilai", [fields.Nilai.visible && fields.Nilai.required ? ew.Validators.required(fields.Nilai.caption) : null], fields.Nilai.isInvalid]
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fstatusadd" id="fstatusadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="status">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->NomorStatus->Visible) { // NomorStatus ?>
    <div id="r_NomorStatus"<?= $Page->NomorStatus->rowAttributes() ?>>
        <label id="elh_status_NomorStatus" for="x_NomorStatus" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_status_NomorStatus"><?= $Page->NomorStatus->caption() ?><?= $Page->NomorStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NomorStatus->cellAttributes() ?>>
<template id="tpx_status_NomorStatus"><span id="el_status_NomorStatus">
<input type="<?= $Page->NomorStatus->getInputTextType() ?>" name="x_NomorStatus" id="x_NomorStatus" data-table="status" data-field="x_NomorStatus" value="<?= $Page->NomorStatus->EditValue ?>" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->NomorStatus->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->NomorStatus->formatPattern()) ?>"<?= $Page->NomorStatus->editAttributes() ?> aria-describedby="x_NomorStatus_help">
<?= $Page->NomorStatus->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NomorStatus->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Status->Visible) { // Status ?>
    <div id="r_Status"<?= $Page->Status->rowAttributes() ?>>
        <label id="elh_status_Status" for="x_Status" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_status_Status"><?= $Page->Status->caption() ?><?= $Page->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Status->cellAttributes() ?>>
<template id="tpx_status_Status"><span id="el_status_Status">
<input type="<?= $Page->Status->getInputTextType() ?>" name="x_Status" id="x_Status" data-table="status" data-field="x_Status" value="<?= $Page->Status->EditValue ?>" size="30" maxlength="24" placeholder="<?= HtmlEncode($Page->Status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Status->formatPattern()) ?>"<?= $Page->Status->editAttributes() ?> aria-describedby="x_Status_help">
<?= $Page->Status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Status->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Nilai->Visible) { // Nilai ?>
    <div id="r_Nilai"<?= $Page->Nilai->rowAttributes() ?>>
        <label id="elh_status_Nilai" for="x_Nilai" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_status_Nilai"><?= $Page->Nilai->caption() ?><?= $Page->Nilai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Nilai->cellAttributes() ?>>
<template id="tpx_status_Nilai"><span id="el_status_Nilai">
<input type="<?= $Page->Nilai->getInputTextType() ?>" name="x_Nilai" id="x_Nilai" data-table="status" data-field="x_Nilai" value="<?= $Page->Nilai->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->Nilai->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->Nilai->formatPattern()) ?>"<?= $Page->Nilai->editAttributes() ?> aria-describedby="x_Nilai_help">
<?= $Page->Nilai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Nilai->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_statusadd" class="ew-custom-template"></div>
<template id="tpm_statusadd">
<div id="ct_StatusAdd"><div class="container mt-3" style="padding-left: 0px;">
    <h2>INPUT STATUS</h2>
    <div class="row mt-5">
        <div class="col-xs-12 col-sm-9 col-lg-8">
			<div class="card text-dark shadow p-3 mb-5 bg-body rounded-4 border-0">
				<div class="card-body">
					<div class="row mb-3">
						<label id="elh_status_NomorStatus" for="x_NomorStatus" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->NomorStatus->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_status_NomorStatus"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_status_Status" for="x_Status" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->Status->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_status_Status"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_status_Nilai" for="x_Nilai" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->Nilai->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_status_Nilai"></slot></div>
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fstatusadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fstatusadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_statusadd", "tpm_statusadd", "statusadd", "<?= $Page->Export ?>", "status", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
    ew.addEventHandlers("status");
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
