<?php
namespace PHPMaker2020\signwords;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(9, "mi_users", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "userslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_accounts", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "accountslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_packags", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "packagslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(20, "mi_news", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "newslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>