<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$SubscriptionAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { subscription: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fsubscriptionadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsubscriptionadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["NomorSubscription", [fields.NomorSubscription.visible && fields.NomorSubscription.required ? ew.Validators.required(fields.NomorSubscription.caption) : null], fields.NomorSubscription.isInvalid],
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
<form name="fsubscriptionadd" id="fsubscriptionadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="subscription">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->NomorSubscription->Visible) { // NomorSubscription ?>
    <div id="r_NomorSubscription"<?= $Page->NomorSubscription->rowAttributes() ?>>
        <label id="elh_subscription_NomorSubscription" for="x_NomorSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_subscription_NomorSubscription"><?= $Page->NomorSubscription->caption() ?><?= $Page->NomorSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->NomorSubscription->cellAttributes() ?>>
<template id="tpx_subscription_NomorSubscription"><span id="el_subscription_NomorSubscription">
<input type="<?= $Page->NomorSubscription->getInputTextType() ?>" name="x_NomorSubscription" id="x_NomorSubscription" data-table="subscription" data-field="x_NomorSubscription" value="<?= $Page->NomorSubscription->EditValue ?>" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->NomorSubscription->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->NomorSubscription->formatPattern()) ?>"<?= $Page->NomorSubscription->editAttributes() ?> aria-describedby="x_NomorSubscription_help">
<?= $Page->NomorSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NomorSubscription->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JenisSubscription->Visible) { // JenisSubscription ?>
    <div id="r_JenisSubscription"<?= $Page->JenisSubscription->rowAttributes() ?>>
        <label id="elh_subscription_JenisSubscription" for="x_JenisSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_subscription_JenisSubscription"><?= $Page->JenisSubscription->caption() ?><?= $Page->JenisSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->JenisSubscription->cellAttributes() ?>>
<template id="tpx_subscription_JenisSubscription"><span id="el_subscription_JenisSubscription">
<input type="<?= $Page->JenisSubscription->getInputTextType() ?>" name="x_JenisSubscription" id="x_JenisSubscription" data-table="subscription" data-field="x_JenisSubscription" value="<?= $Page->JenisSubscription->EditValue ?>" size="30" maxlength="240" placeholder="<?= HtmlEncode($Page->JenisSubscription->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->JenisSubscription->formatPattern()) ?>"<?= $Page->JenisSubscription->editAttributes() ?> aria-describedby="x_JenisSubscription_help">
<?= $Page->JenisSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->JenisSubscription->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->BulanSubscription->Visible) { // BulanSubscription ?>
    <div id="r_BulanSubscription"<?= $Page->BulanSubscription->rowAttributes() ?>>
        <label id="elh_subscription_BulanSubscription" for="x_BulanSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_subscription_BulanSubscription"><?= $Page->BulanSubscription->caption() ?><?= $Page->BulanSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->BulanSubscription->cellAttributes() ?>>
<template id="tpx_subscription_BulanSubscription"><span id="el_subscription_BulanSubscription">
<input type="<?= $Page->BulanSubscription->getInputTextType() ?>" name="x_BulanSubscription" id="x_BulanSubscription" data-table="subscription" data-field="x_BulanSubscription" value="<?= $Page->BulanSubscription->EditValue ?>" size="30" maxlength="240" placeholder="<?= HtmlEncode($Page->BulanSubscription->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->BulanSubscription->formatPattern()) ?>"<?= $Page->BulanSubscription->editAttributes() ?> aria-describedby="x_BulanSubscription_help">
<?= $Page->BulanSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->BulanSubscription->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KeteranganSubscription->Visible) { // KeteranganSubscription ?>
    <div id="r_KeteranganSubscription"<?= $Page->KeteranganSubscription->rowAttributes() ?>>
        <label id="elh_subscription_KeteranganSubscription" for="x_KeteranganSubscription" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_subscription_KeteranganSubscription"><?= $Page->KeteranganSubscription->caption() ?><?= $Page->KeteranganSubscription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->KeteranganSubscription->cellAttributes() ?>>
<template id="tpx_subscription_KeteranganSubscription"><span id="el_subscription_KeteranganSubscription">
<input type="<?= $Page->KeteranganSubscription->getInputTextType() ?>" name="x_KeteranganSubscription" id="x_KeteranganSubscription" data-table="subscription" data-field="x_KeteranganSubscription" value="<?= $Page->KeteranganSubscription->EditValue ?>" size="30" maxlength="240" placeholder="<?= HtmlEncode($Page->KeteranganSubscription->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->KeteranganSubscription->formatPattern()) ?>"<?= $Page->KeteranganSubscription->editAttributes() ?> aria-describedby="x_KeteranganSubscription_help">
<?= $Page->KeteranganSubscription->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KeteranganSubscription->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_subscriptionadd" class="ew-custom-template"></div>
<template id="tpm_subscriptionadd">
<div id="ct_SubscriptionAdd"><div class="container mt-3" style="padding-left: 0px;">
    <h2>INPUT LANGGANAN</h2>
    <div class="row mt-5">
        <div class="col-xs-12 col-sm-9 col-lg-8">
			<div class="card text-dark shadow p-3 mb-5 bg-body rounded-4 border-0">
				<div class="card-body">
					<div class="row mb-3">
						<label id="elh_subscription_NomorSubscription" for="x_NomorSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->NomorSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_subscription_NomorSubscription"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_subscription_JenisSubscription" for="x_JenisSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->JenisSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_subscription_JenisSubscription"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_subscription_BulanSubscription" for="x_BulanSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->BulanSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_subscription_BulanSubscription"></slot></div>
						</div>
					</div>
                    <div class="row mb-3">
						<label id="elh_subscription_KeteranganSubscription" for="x_KeteranganSubscription" class="col-sm-4 col-form-label ewLabel">
							<?= $Page->KeteranganSubscription->caption() ?>
						</label>
						<div class="col-sm-8">
							<div><slot class="ew-slot" name="tpx_subscription_KeteranganSubscription"></slot></div>
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fsubscriptionadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fsubscriptionadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_subscriptionadd", "tpm_subscriptionadd", "subscriptionadd", "<?= $Page->Export ?>", "subscription", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
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
    ew.addEventHandlers("subscription");
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
