<?

use Bitrix\Main\Page\Asset;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>

<div id="panel">
	<? $APPLICATION->ShowPanel(); ?>
</div>

<head>
	<? $APPLICATION->ShowHead(); ?>
	<title><? $APPLICATION->ShowTitle(); ?></title>
	<?php
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/template_styles.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/styles.css");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/slick.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/jquery.flexslider.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/jquery.fancybox.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/jquery.zoom.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/jquery.fancybox-media.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/scripts.js");
	Asset::getInstance()->addString('<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>');
	Asset::getInstance()->addString('<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>');
	Asset::getInstance()->addString('<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>');
	?>
	<section id="wrapper">

		<!-- start header -->
		<header id="header">
			<div class="inner">
				<div id="logo">
					<a href="#" title="Site name">
						<!-- logo should be used as background -->
					</a>
				</div>

				<div class="search-section">
					<!-- start form -->
					<form action="" method="post">
						<fieldset>
							<div class="search">
								<input type="text" name="search-input" placeholder="Поиск по названию и номеру артикула" value="" />
								<input type="submit" name="submit" value="" />
							</div>
						</fieldset>
					</form>
					<!-- end of form -->
				</div>

				<div class="phones">
					<div class="phone">
						<? $APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_TEMPLATE_PATH . "/includes/header_phone.php"
							)
						); ?>
						<span>
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_TEMPLATE_PATH . "/includes/header_time.php",
								)
							); ?>
						</span>
					</div>

					<div class="phone">
						<? $APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_TEMPLATE_PATH . "/includes/header_secondphone.php",
							)
						); ?>
						<span>
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_TEMPLATE_PATH . "/includes/header_secondtime.php",
								)
							); ?>
						</span>
					</div>
				</div>

				<div class="acount-info">
					<div class="login">
						<a href="#">Зарегистрироваться</a>
						<a href="#">Войти</a>
					</div>

					<div class="bag">
						<div>
							<? $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"bag", 
	array(
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "Y",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_NUM_PRODUCTS" => "N",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRODUCTS" => "N",
		"SHOW_REGISTRATION" => "Y",
		"SHOW_TOTAL_PRICE" => "N",
		"COMPONENT_TEMPLATE" => "bag"
	),
	false
); ?>
						</div>
					</div>
				</div>

				<div class="mobile-menu"><span></span>
					<div>МЕНЮ</div>
				</div>
			</div>
		</header>

		<? $APPLICATION->IncludeComponent(
			"bitrix:menu",
			"top_menu",
			array(
				"COMPONENT_TEMPLATE" => "top_menu",
				"ROOT_MENU_TYPE" => "top",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"MENU_CACHE_GET_VARS" => array(),
				"MAX_LEVEL" => "1",
				"CHILD_MENU_TYPE" => "left",
				"USE_EXT" => "N",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N"
			),
			false
		); ?>
</head>

<body>