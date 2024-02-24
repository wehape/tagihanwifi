<?php

namespace PHPMaker2024\tagihanwifi01;

// Page object
$Dashboard2 = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php
    include('wehape/conf.php');
?>
<div class="row">
	<div class="col-xs-12 col-sm-3 col-lg-3 mb-3">
		<a href="/tagihanwifi/DataPelangganList">
			<div class="card bg-secondary text-white border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 align-items-center">
							<div class="text-xs text-uppercase mb-1">Registered Member</div>
							<div class="h5 mb-0">
								<?php
									$mem_query = "SELECT NomorPelanggan FROM data_pelanggan ORDER BY NomorPelanggan";
									$mem_query_run = mysqli_query($connection, $mem_query);
									$mem_row = mysqli_num_rows($mem_query_run);
									echo '<p class="card-text mb-0" style="text-transform: uppercase; font-weight: bold; font-size: 72px;">'.$mem_row.'</p>';
								?>
							</div>
							<div class="text-xs text-uppercase mt-1">online</div>
						</div>
						<div class="col-auto">
							<i class="fa-duotone fa-circle-user fa-8x" style="--fa-primary-color: #cccccc; --fa-secondary-color: #ffffff;"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-12 col-sm-3 col-lg-3 mb-3">
		<a href="/tagihanwifi/BroadcastList?cmd=reset">
			<div class="card bg-primary text-white border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 align-items-center">
							<div class="text-xs text-uppercase mb-1">Broadcast</div>
							<div class="h5 mb-0">
								<?php
									$bc_query = "SELECT NomorBC FROM broadcast";
									$bc_query_run = mysqli_query($connection, $bc_query);
									$bc_row = mysqli_num_rows($bc_query_run);
									echo '<p class="card-text mb-0" style="text-transform: uppercase; font-weight: bold; font-size: 72px;">'.$bc_row.'</p>';
								?>
							</div>
							<div class="text-xs text-uppercase mt-1">terkirim</div>
						</div>
						<div class="col-auto">
							<i class="fa-duotone fa-chart-mixed-up-circle-dollar fa-8x" style="--fa-primary-color: #cccccc; --fa-secondary-color: #ffffff;"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-12 col-sm-3 col-lg-3 mb-3">
		<a href="/tagihanwifi/BroadcastList?search=lunas&searchtype=&cmd=search">
			<div class="card bg-success text-white border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 align-items-center">
							<div class="text-xs text-uppercase mb-1">Broadcast Paid</div>
							<div class="h5 mb-0">
								<?php
									$paid_query = "SELECT * FROM broadcast WHERE Nilai='1' ";
									$paid_query_run = mysqli_query($connection, $paid_query);
									$paid_row = mysqli_num_rows($paid_query_run);
									echo '<p class="card-text mb-0" style="text-transform: uppercase; font-weight: bold; font-size: 72px;">'.$paid_row.'</p>';
								?>
							</div>
							<div class="text-xs text-uppercase mt-1">
								<?php
									$totalpaid_query = "SELECT *, SUM(Tagihan) AS sum FROM broadcast WHERE Nilai='1' ";
									$totalpaid_query_run = mysqli_query($connection, $totalpaid_query);
									$totalpaid_row = mysqli_fetch_assoc($totalpaid_query_run);
									$paidNumber = $totalpaid_row['sum'];
									$money_Paid = number_format($paidNumber,2,',','.');
									echo '<p class="card-text mb-0">'.'Rp '.$money_Paid.'</p>';
								?>
							</div>
						</div>
						<div class="col-auto">
							<i class="fa-duotone fa-money-bill-transfer fa-8x" style="--fa-primary-color: #cccccc; --fa-secondary-color: #ffffff;"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-12 col-sm-3 col-lg-3 mb-3">
		<a href="/tagihanwifi/BroadcastList?search=belum+bayar&searchtype=&cmd=search">
			<div class="card bg-danger text-white border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 align-items-center">
							<div class="text-xs text-uppercase mb-1">Broadcast unpaid</div>
							<div class="h5 mb-0">
								<?php
									$unpaid_query = "SELECT * FROM broadcast WHERE Nilai='0' ";
									$unpaid_query_run = mysqli_query($connection, $unpaid_query);
									$unpaid_row = mysqli_num_rows($unpaid_query_run);
									echo '<p class="card-text mb-0" style="text-transform: uppercase; font-weight: bold; font-size: 72px;">'.$unpaid_row.'</p>';
								?>
							</div>
							<div class="text-xs text-uppercase mt-1">
								<?php
									$totalunpaid_query = "SELECT *, SUM(Tagihan) AS sum FROM broadcast WHERE Nilai='0' ";
									$totalunpaid_query_run = mysqli_query($connection, $totalunpaid_query);
									$totalunpaid_row = mysqli_fetch_assoc($totalunpaid_query_run);
									$unpaidNumber = $totalunpaid_row['sum'];
									$money_unPaid = number_format($unpaidNumber,2,',','.');
									echo '<p class="card-text mb-0">'.'Rp '.$money_unPaid.'</p>';
								?>
							</div>
						</div>
						<div class="col-auto">
							<i class="fa-duotone fa-money-check-dollar-pen fa-8x" style="--fa-primary-color: #cccccc; --fa-secondary-color: #ffffff;"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 8rem; margin-bottom: 1rem; text-align: center;">
    <p class="card-text" style="text-shadow: 1px -1px 0px rgba(0,0,0,0.50), 0 4px 10px rgba(0,0,0,0.23); text-transform: uppercase; font-weight: bold; font-size: 20px; margin-top: 4rem; background: #00CF3E; background: linear-gradient(to right, #00CF3E 0%, #AECF0A 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">quick menu</p>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-4 col-lg-4 mb-3">
	</div>
    <div class="col-xs-12 col-sm-2 col-lg-2 mb-3">
		<a href="/tagihanwifi/DataPelangganAdd">
			<div class="card bg-secondary text-white border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 align-items-center">
							<div class="text-xs text-uppercase mb-1">Register Member</div>
							<div class="text-xs text-uppercase mt-1">Baru</div>
						</div>
						<div class="col-auto">
							<i class="fa-duotone fa-users-medical fa-4x" style="--fa-primary-color: #cccccc; --fa-secondary-color: #ffffff;"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
    <div class="col-xs-12 col-sm-2 col-lg-2 mb-3">
		<a href="/tagihanwifi/BroadcastAdd">
			<div class="card bg-primary text-white border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2 align-items-center">
							<div class="text-xs text-uppercase mb-1">rilis boardcast</div>
							<div class="text-xs text-uppercase mt-1">baru</div>
						</div>
						<div class="col-auto">
							<i class="fa-duotone fa-receipt fa-4x" style="--fa-primary-color: #cccccc; --fa-secondary-color: #ffffff;"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
    <div class="col-xs-12 col-sm-4 col-lg-4 mb-3">
	</div>
</div>
<?= GetDebugMessage() ?>
