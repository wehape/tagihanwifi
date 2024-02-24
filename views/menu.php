<?php

namespace PHPMaker2024\tagihanwifi01;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(21, "mci_DASHBOARD", $Language->menuPhrase("21", "MenuText"), "", -1, "", true, true, true, "fa-duotone fa-house fa-fw mr-2", "", false, true);
$sideMenu->addMenuItem(13, "mi_dashboard2", $Language->menuPhrase("13", "MenuText"), "Dashboard2", 21, "", true, false, false, "fad fa-chart-pie fa-fw mr-2", "", false, true);
$sideMenu->addMenuItem(10, "mci_BILLING", $Language->menuPhrase("10", "MenuText"), "", -1, "", true, true, true, "fa-duotone fa-display-chart-up-circle-dollar fa-fw mr-2", "", false, true);
$sideMenu->addMenuItem(4, "mi_broadcast", $Language->menuPhrase("4", "MenuText"), "BroadcastList", 10, "", true, false, false, "fa-duotone fa-ballot-check fa-fw mr-2", "", false, true);
$sideMenu->addMenuItem(31, "mci_REPORT", $Language->menuPhrase("31", "MenuText"), "", -1, "", true, true, true, "", "", false, true);
$sideMenu->addMenuItem(22, "mi_Billing_Report", $Language->menuPhrase("22", "MenuText"), "BillingReport", 31, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(11, "mci_SETTING", $Language->menuPhrase("11", "MenuText"), "", -1, "", true, true, true, "fa-duotone fa-gear fa-fw mr-2", "", false, true);
$sideMenu->addMenuItem(1, "mi_data_pelanggan", $Language->menuPhrase("1", "MenuText"), "DataPelangganList", 11, "", true, false, false, "fa-duotone fa-circle-user fa-fw mr-2", "", false, true);
$sideMenu->addMenuItem(2, "mi_bandwidth", $Language->menuPhrase("2", "MenuText"), "BandwidthList", 11, "", true, false, false, "fa-duotone fa-mobile-signal-out fa-fw mr-2", "", false, true);
$sideMenu->addMenuItem(3, "mi_status", $Language->menuPhrase("3", "MenuText"), "StatusList", 11, "", true, false, false, "fa-duotone fa-message-exclamation fa-fw mr-2", "", false, true);
$sideMenu->addMenuItem(12, "mi_subscription", $Language->menuPhrase("12", "MenuText"), "SubscriptionList", 11, "", true, false, false, "fa-duotone fa-money-check-dollar-pen fa-fw mr-2", "", false, true);
echo $sideMenu->toScript();
