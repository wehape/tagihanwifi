<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\tagihanwifi01;

/**
 * User levels
 *
 * @var array<int, string>
 * [0] int User level ID
 * [1] string User level name
 */
$USER_LEVELS = [["-2","Anonymous"]];

/**
 * User level permissions
 *
 * @var array<string, int, int>
 * [0] string Project ID + Table name
 * [1] int User level ID
 * [2] int Permissions
 */
$USER_LEVEL_PRIVS = [["{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}broadcast","-2","0"],
    ["{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}data_pelanggan","-2","0"],
    ["{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}bandwidth","-2","0"],
    ["{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}status","-2","0"],
    ["{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}subscription","-2","0"],
    ["{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}dashboard.php","-2","0"],
    ["{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}Billing Report","-2","0"]];

/**
 * Tables
 *
 * @var array<string, string, string, bool, string>
 * [0] string Table name
 * [1] string Table variable name
 * [2] string Table caption
 * [3] bool Allowed for update (for userpriv.php)
 * [4] string Project ID
 * [5] string URL (for OthersController::index)
 */
$USER_LEVEL_TABLES = [["broadcast","broadcast","BROADCAST",true,"{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}","BroadcastList"],
    ["data_pelanggan","data_pelanggan","PELANGGAN",true,"{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}","DataPelangganList"],
    ["bandwidth","bandwidth","BANDWIDTH",true,"{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}","BandwidthList"],
    ["status","status","STATUS BAYAR",true,"{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}","StatusList"],
    ["subscription","subscription","SUBSCRIPTION",true,"{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}","SubscriptionList"],
    ["dashboard.php","dashboard2","DASHBOARD",true,"{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}","Dashboard2"],
    ["Billing Report","Billing_Report","BILLING REPORT",true,"{DFF643BB-1BDC-4D8E-80AE-E4023B20174F}","BillingReport"]];
