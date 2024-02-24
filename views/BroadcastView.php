<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$BroadcastView = &$Page;
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
<form name="fbroadcastview" id="fbroadcastview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { broadcast: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fbroadcastview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fbroadcastview")
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
<input type="hidden" name="t" value="broadcast">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->NomorBC->Visible) { // NomorBC ?>
    <tr id="r_NomorBC"<?= $Page->NomorBC->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_NomorBC"><template id="tpc_broadcast_NomorBC"><?= $Page->NomorBC->caption() ?></template></span></td>
        <td data-name="NomorBC"<?= $Page->NomorBC->cellAttributes() ?>>
<template id="tpx_broadcast_NomorBC"><span id="el_broadcast_NomorBC">
<span<?= $Page->NomorBC->viewAttributes() ?>>
<?= $Page->NomorBC->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Tahun->Visible) { // Tahun ?>
    <tr id="r_Tahun"<?= $Page->Tahun->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_Tahun"><template id="tpc_broadcast_Tahun"><?= $Page->Tahun->caption() ?></template></span></td>
        <td data-name="Tahun"<?= $Page->Tahun->cellAttributes() ?>>
<template id="tpx_broadcast_Tahun"><span id="el_broadcast_Tahun">
<span<?= $Page->Tahun->viewAttributes() ?>>
<?= $Page->Tahun->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Bulan->Visible) { // Bulan ?>
    <tr id="r_Bulan"<?= $Page->Bulan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_Bulan"><template id="tpc_broadcast_Bulan"><?= $Page->Bulan->caption() ?></template></span></td>
        <td data-name="Bulan"<?= $Page->Bulan->cellAttributes() ?>>
<template id="tpx_broadcast_Bulan"><span id="el_broadcast_Bulan">
<span<?= $Page->Bulan->viewAttributes() ?>>
<?= $Page->Bulan->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Tanggal->Visible) { // Tanggal ?>
    <tr id="r_Tanggal"<?= $Page->Tanggal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_Tanggal"><template id="tpc_broadcast_Tanggal"><?= $Page->Tanggal->caption() ?></template></span></td>
        <td data-name="Tanggal"<?= $Page->Tanggal->cellAttributes() ?>>
<template id="tpx_broadcast_Tanggal"><span id="el_broadcast_Tanggal">
<span<?= $Page->Tanggal->viewAttributes() ?>>
<?= $Page->Tanggal->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NamaPelanggan->Visible) { // NamaPelanggan ?>
    <tr id="r_NamaPelanggan"<?= $Page->NamaPelanggan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_NamaPelanggan"><template id="tpc_broadcast_NamaPelanggan"><?= $Page->NamaPelanggan->caption() ?></template></span></td>
        <td data-name="NamaPelanggan"<?= $Page->NamaPelanggan->cellAttributes() ?>>
<template id="tpx_broadcast_NamaPelanggan"><span id="el_broadcast_NamaPelanggan">
<span<?= $Page->NamaPelanggan->viewAttributes() ?>>
<?= $Page->NamaPelanggan->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->IP->Visible) { // IP ?>
    <tr id="r_IP"<?= $Page->IP->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_IP"><template id="tpc_broadcast_IP"><?= $Page->IP->caption() ?></template></span></td>
        <td data-name="IP"<?= $Page->IP->cellAttributes() ?>>
<template id="tpx_broadcast_IP"><span id="el_broadcast_IP">
<span<?= $Page->IP->viewAttributes() ?>>
<?= $Page->IP->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Bandwidth->Visible) { // Bandwidth ?>
    <tr id="r_Bandwidth"<?= $Page->Bandwidth->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_Bandwidth"><template id="tpc_broadcast_Bandwidth"><?= $Page->Bandwidth->caption() ?></template></span></td>
        <td data-name="Bandwidth"<?= $Page->Bandwidth->cellAttributes() ?>>
<template id="tpx_broadcast_Bandwidth"><span id="el_broadcast_Bandwidth">
<span<?= $Page->Bandwidth->viewAttributes() ?>>
<?= $Page->Bandwidth->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Tagihan->Visible) { // Tagihan ?>
    <tr id="r_Tagihan"<?= $Page->Tagihan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_Tagihan"><template id="tpc_broadcast_Tagihan"><?= $Page->Tagihan->caption() ?></template></span></td>
        <td data-name="Tagihan"<?= $Page->Tagihan->cellAttributes() ?>>
<template id="tpx_broadcast_Tagihan"><span id="el_broadcast_Tagihan">
<span<?= $Page->Tagihan->viewAttributes() ?>>
<?= $Page->Tagihan->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->JenisSubscription->Visible) { // JenisSubscription ?>
    <tr id="r_JenisSubscription"<?= $Page->JenisSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_JenisSubscription"><template id="tpc_broadcast_JenisSubscription"><?= $Page->JenisSubscription->caption() ?></template></span></td>
        <td data-name="JenisSubscription"<?= $Page->JenisSubscription->cellAttributes() ?>>
<template id="tpx_broadcast_JenisSubscription"><span id="el_broadcast_JenisSubscription">
<span<?= $Page->JenisSubscription->viewAttributes() ?>>
<?= $Page->JenisSubscription->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BulanSubscription->Visible) { // BulanSubscription ?>
    <tr id="r_BulanSubscription"<?= $Page->BulanSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_BulanSubscription"><template id="tpc_broadcast_BulanSubscription"><?= $Page->BulanSubscription->caption() ?></template></span></td>
        <td data-name="BulanSubscription"<?= $Page->BulanSubscription->cellAttributes() ?>>
<template id="tpx_broadcast_BulanSubscription"><span id="el_broadcast_BulanSubscription">
<span<?= $Page->BulanSubscription->viewAttributes() ?>>
<?= $Page->BulanSubscription->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KeteranganSubscription->Visible) { // KeteranganSubscription ?>
    <tr id="r_KeteranganSubscription"<?= $Page->KeteranganSubscription->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_KeteranganSubscription"><template id="tpc_broadcast_KeteranganSubscription"><?= $Page->KeteranganSubscription->caption() ?></template></span></td>
        <td data-name="KeteranganSubscription"<?= $Page->KeteranganSubscription->cellAttributes() ?>>
<template id="tpx_broadcast_KeteranganSubscription"><span id="el_broadcast_KeteranganSubscription">
<span<?= $Page->KeteranganSubscription->viewAttributes() ?>>
<?= $Page->KeteranganSubscription->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Status->Visible) { // Status ?>
    <tr id="r_Status"<?= $Page->Status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_Status"><template id="tpc_broadcast_Status"><?= $Page->Status->caption() ?></template></span></td>
        <td data-name="Status"<?= $Page->Status->cellAttributes() ?>>
<template id="tpx_broadcast_Status"><span id="el_broadcast_Status">
<span<?= $Page->Status->viewAttributes() ?>>
<?= $Page->Status->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Nilai->Visible) { // Nilai ?>
    <tr id="r_Nilai"<?= $Page->Nilai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_broadcast_Nilai"><template id="tpc_broadcast_Nilai"><?= $Page->Nilai->caption() ?></template></span></td>
        <td data-name="Nilai"<?= $Page->Nilai->cellAttributes() ?>>
<template id="tpx_broadcast_Nilai"><span id="el_broadcast_Nilai">
<span<?= $Page->Nilai->viewAttributes() ?>>
<?= $Page->Nilai->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_broadcastview" class="ew-custom-template"></div>
<template id="tpm_broadcastview">
<div id="ct_BroadcastView"><div id="capture" class="card text-bg-light" style="width: 1080px; height: 1775px;">
	<img src="../wehape/img06.jpg" class="card-img" alt="..." style="object-fit: cover; height: 1775px;">
	<div class="card-img-overlay">
		<div class="col-lg-12 col-md-12 col-sm-12 mb-4" style="margin-bottom: 1rem;">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 64px; margin-bottom: .1rem; margin-top: 5.5rem; background: #2390CF; background: linear-gradient(to right, #2390CF 0%, #CF4FCB 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">
						broadcast
					</p>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<img style="float: right; margin-top: 5rem;" src="../wehape/logo01.png" height="120px"></img>
				</div>
			</div>
		</div>
		<div class="card text-bg-dark rounded-4 border-0" style="box-shadow: 0 4px 10px rgba(0,0,0,0.16), 0 4px 10px rgba(0,0,0,0.23); max-height: 100px;">
			<img src="../wehape/img04.jpg" class="card-img" alt="..." style="object-fit: cover; max-height: 100px;"></img>
			<div class="card-img-overlay">
				<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 1rem;">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2">
							<p class="card-text" style="margin-bottom: 0.25rem;">No. INV</p>
							<p class="card-text" style="margin-bottom: 0.25rem;">Date</p>
							<p class="card-text" style="margin-bottom: 0.25rem; font-weight: bold; background: #FF0A0A; background: linear-gradient(to right, #FF0A0A 0%, #FFE600 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">Due Date</p>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-5">
							<p class="card-text" style="margin-bottom: 0.25rem;">:<slot class="ew-slot" name="tpx_broadcast_NomorBC"></slot></p>
							<p class="card-text" style="margin-bottom: 0.25rem;">:<slot class="ew-slot" name="tpx_broadcast_Tanggal"></slot></p>
							<p class="card-text" style="margin-bottom: 0.25rem; font-weight: bold; background: #FF0A0A; background: linear-gradient(to left, #FF0A0A 0%, #FFE600 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">:&nbsp;05 <slot class="ew-slot" name="tpx_broadcast_Bulan"></slot><slot class="ew-slot" name="tpx_broadcast_Tahun"></slot></p>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<p class="card-text" style="margin-bottom: 0.25rem;">Account</p>
							<p class="card-text" style="margin-bottom: 0.25rem;">Bandwidth</p>
							<p class="card-text" style="margin-bottom: 0.25rem; font-weight: bold; background: #11CF83; background: linear-gradient(to right, #11CF83 0%, #CFCA38 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">Subscription</p>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<p class="card-text" style="margin-bottom: 0.25rem;">:<slot class="ew-slot" name="tpx_broadcast_NamaPelanggan"></slot></p>
							<p class="card-text" style="margin-bottom: 0.25rem;">:<slot class="ew-slot" name="tpx_broadcast_Bandwidth"></slot></p>
							<p class="card-text" style="margin-bottom: 0.25rem; text-transform: uppercase; font-weight: bold; background: #11CF83; background: linear-gradient(to left, #11CF83 0%, #CFCA38 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">:<slot class="ew-slot" name="tpx_broadcast_JenisSubscription"></slot></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card bg-light text-dark rounded-4 border-0" style="box-shadow: 0 4px 10px rgba(0,0,0,0.16), 0 4px 10px rgba(0,0,0,0.23); height: 450px;">
			<img src="../wehape/img02.jpg" class="card-img" alt="..." style="object-fit: cover; max-height: 450px;"></img>
			<div class="card-img-overlay">
				<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 1rem;">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2">
							<h3 class="mb-3" style="text-transform: uppercase; font-weight: bold;">no.</h3>
							<h5 class="card-text mt-5" style="margin-bottom: 0.25rem;">01.</h5>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h3 class="mb-3" style="text-transform: uppercase; font-weight: bold;">descriptions</h3>
							<h4 class="card-text" style="margin-bottom: 0.25rem;">Internet<slot class="ew-slot" name="tpx_broadcast_Bandwidth"></slot></h4>
							<h5 class="card-text" style="margin-bottom: 0.25rem;">Biaya<slot class="ew-slot" name="tpx_broadcast_KeteranganSubscription"></slot>waktu satu bulan pemakaian.</h5>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<h3 class="mb-3" style="text-transform: uppercase; font-weight: bold;">price</h3>
							<h5 class="card-text mt-5" style="margin-bottom: 0.25rem;"><slot class="ew-slot" name="tpx_broadcast_Tagihan"></slot></h5>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<h3 class="mb-3" style="text-transform: uppercase; font-weight: bold;">total</h3>
							<h5 class="card-text mt-5" style="margin-bottom: 0.25rem;"><slot class="ew-slot" name="tpx_broadcast_Tagihan"></slot></h5>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 1rem; margin-top: 10rem;">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8">
							<!--- ### --->
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<p class="card-text mb-3" style="text-transform: uppercase; font-weight: bold; color: grey;">subtotal</p>
							<p class="card-text mb-3" style="text-transform: uppercase; font-weight: bold; color: grey;">charge</p>
							<p class="card-text mb-3" style="text-transform: uppercase; font-weight: bold; color: grey;">discount</p>
							<p class="card-text mb-3" style="text-transform: uppercase; font-weight: bold; color: grey;">grand total</p>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2">
							<p class="card-text mb-3" style="text-transform: uppercase; font-weight: bold;"><slot class="ew-slot" name="tpx_broadcast_Tagihan"></slot></p>
							<p class="card-text mb-3" style="text-transform: uppercase; font-weight: bold;">rp 0,00</p>
							<p class="card-text mb-3" style="text-transform: uppercase; font-weight: bold;">rp 0,00</p>
							<p class="card-text mb-3" style="text-transform: uppercase; font-weight: bold;"><slot class="ew-slot" name="tpx_broadcast_Tagihan"></slot></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 mb-4" style="margin-bottom: 1rem;">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6" style="text-align: center;">
					<h3 style="text-transform: uppercase; font-weight: bold; margin-bottom: 0rem; margin-top: 1.5rem; background: #CF0E15; background: #B617CF; background: linear-gradient(to right, #B617CF 0%, #21CFAC 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">
                        Payment Method
                    </h3>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<!--- <img style="float: right;" src="../wehape/logo01.png" height="120px"></img> --->
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 1rem;">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="card mb-3" style="padding-left: 3rem">
						<div class="row g-0" style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/Mandiri.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">184-00-00-71-777-5</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : transfer</p>
								</div>
							</div>
						</div>
						<div class="row g-0"style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/BRI.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0.5rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body" style="padding-top: 0rem">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">590-00-10-21-244-533</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : transfer</p>
								</div>
							</div>
						</div>
						<div class="row g-0"style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/BNI.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0.3rem; padding-right: 0.5rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body" style="padding-top: 0rem">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">130-05-416-56</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : transfer</p>
								</div>
							</div>
						</div>
						<div class="row g-0"style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/BCA.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0.5rem; padding-right: 0.5rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body" style="padding-top: 0rem">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">247-05-974-99</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : transfer</p>
								</div>
							</div>
						</div>
						<div class="row g-0"style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/jateng.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0rem; padding-right: 0.75rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body" style="padding-top: 0rem">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">2-068-07-21-26</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : transfer</p>
								</div>
							</div>
						</div>
						<div class="row g-0"style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/SeaBank.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0.5rem; padding-right: 0.5rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body" style="padding-top: 0rem">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">9018-8823-9648</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : transfer</p>
								</div>
							</div>
						</div>
						<div class="row g-0"style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/Alfamart.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body" style="padding-top: 0rem">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">085-740-568-949</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : topup dana via alfamart</p>
								</div>
							</div>
						</div>
						<div class="row g-0"style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/ShopeePay.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0.5rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body" style="padding-top: 0rem">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">085-740-568-949</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : topup / transfer</p>
								</div>
							</div>
						</div>
						<div class="row g-0"style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/Dana.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0.5rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body" style="padding-top: 0rem">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">085-740-568-949</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : topup / transfer</p>
								</div>
							</div>
						</div>
						<div class="row g-0"style="margin-bottom: 0rem;">
							<div class="col-md-4">
								<img src="../wehape/Pegadaian2.png" class="card-img" class="img-fluid rounded-start" alt="..." style="padding-left: 0.5rem; padding-top: 0.3rem;"></img>
							</div>
							<div class="col-md-8" style="padding-left: 2.5rem">
								<div class="card-body" style="padding-top: 0rem">
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">843-888-574-056-89-49</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">a.n. WIDODO HADI PRABOWO</p>
									<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 10px; color: red; margin-bottom: 0rem;">note : topup / transfer gcash</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="card text-bg-light rounded-4 border-0 mb-5" style="box-shadow: 0 4px 10px rgba(0,0,0,0.16), 0 4px 10px rgba(0,0,0,0.23); height: 150px;">
						<img src="../wehape/img01.jpg" class="card-img" alt="..." style="object-fit: cover; max-height: 150px;"></img>
						<div class="card-img-overlay" style="padding-left: 4rem;">
							<p class="card-text mt-3" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">&nbsp;amount to be paid</p>
							<p class="card-text" style="text-transform: uppercase; font-weight: bold; font-size: 52px; margin-bottom: 0rem; background: #121FCF; background: linear-gradient(to right, #121FCF 0%, #00A33C 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;"><slot class="ew-slot" name="tpx_broadcast_Tagihan"></slot></p>
						</div>
					</div>
					<div class="mt-5 mb-5">
						<p class="card-text mt-3" style="text-transform: uppercase; font-weight: bold; font-size: 12px; margin-bottom: 0rem;">&nbsp;</p>
					</div>
					<div class="mt-5 mb-5" style="text-align: center;">
						<p class="card-text mt-3" style="text-transform: capitalize; font-size: 24px; margin-bottom: 0rem; background: #CF0000; background: linear-gradient(to top right, #CF0000 0%, #8921CF 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">tagihan bisa dibayarkan</p>
						<p class="card-text" style="text-transform: capitalize; font-size: 24px; margin-bottom: 0rem; background: #CF0000; background: linear-gradient(to right, #CF0000 0%, #8921CF 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">selambat - lambatnya</p>
						<p class="card-text" style="text-transform: capitalize; font-size: 24px; margin-bottom: 0rem; background: #CF0000; background: linear-gradient(to bottom right, #CF0000 0%, #8921CF 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">tanggal 05 (lima) setiap bulannya</p>
					</div>
					<div class="mt-5 mb-4" style="text-align: center;">
						<img src="../wehape/signature01.png" class="card-img" alt="..." style="height: 150px; width: auto;"></img>
					</div>
					<div class="row g-0"style="margin-bottom: 0rem;">
						<div class="col-md-4" style="text-align: center;">
							<p class="card-text" style="font-size: 28px; margin-bottom: 0rem;"><i class="fa-duotone fa-user-headset fa-fw mr-2"></i></p>
                            <p class="card-text" style="font-size: 12px; margin-bottom: 0rem;">+6285740568949</p>
						</div>
                        <div class="col-md-4" style="text-align: center;">
							<p class="card-text" style="font-size: 28px; margin-bottom: 0rem;"><i class="fa-duotone fa-envelope-circle-check fa-fw mr-2"></i></p>
                            <p class="card-text" style="font-size: 12px; margin-bottom: 0rem;">support@wehape.com</p>
						</div>
                        <div class="col-md-4" style="text-align: center;">
							<p class="card-text" style="font-size: 28px; margin-bottom: 0rem;"><i class="fa-duotone fa-map-location-dot fa-fw mr-2"></i></p>
                            <p class="card-text" style="font-size: 12px; margin-bottom: 0rem;">-6.777324720647932, 110.7258546818935</p>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 1rem; text-align: center;">
            <p class="card-text" style="text-shadow: 1px -1px 0px rgba(0,0,0,0.50), 0 4px 10px rgba(0,0,0,0.23); text-transform: uppercase; font-weight: bold; font-size: 20px; margin-top: 4rem; background: #00CF3E; background: linear-gradient(to right, #00CF3E 0%, #AECF0A 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">terimakasih atas perhatian dan kerjasamanya</p>
        </div>
	</div>
</div>
<!---
<button id="btn">Capture</button>
<script src="../wehape/html2canvas.js"></script>
<script>

    function capture() {
        const captureElement = document.querySelector('#capture')
        html2canvas(captureElement, { scale: 5, dpi: 800 })
        .then(canvas => {
        canvas.style.display = 'none'
        document.body.appendChild(canvas)
        return canvas
    })
    .then(canvas => {
        const image = canvas.toDataURL('image/jpg').replace('image/jpg', 'image/octet-stream')
        const a = document.createElement('a')
        a.setAttribute('download', 'my-image.jpg')
        a.setAttribute('href', image)
        a.click()
        canvas.remove()
    })
}
const btn = document.querySelector('#btn')
btn.addEventListener('click', capture)
</script>
---></div>
</template>
</form>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<?php } ?>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_broadcastview", "tpm_broadcastview", "broadcastview", "<?= $Page->Export ?>", "broadcast", ew.templateData.rows[0], <?= $Page->IsModal ? "true" : "false" ?>);
    loadjs.done("customtemplate");
});
</script>
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
