<?

use Bitrix\Main\Page\Asset;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>


<head>
	
	<title><? $APPLICATION->ShowTitle(); ?></title>
	<?php
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/template_styles.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/styles.css");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/slick.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/jquery.flexslider.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/jquery.fancybox.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/jquery.zoom.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/jquery.fancybox-media.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/html5.js");
	
	Asset::getInstance()->addString('<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>');
	Asset::getInstance()->addString('<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>');
	Asset::getInstance()->addString('<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>');
	?>
	<!--[if lt IE 9]>
	<?Asset::getInstance()->addString('<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>');?>
	<![endif]-->
	<?$APPLICATION->ShowHead();?>
</head>

<body>
	<div id="panel">
		<? $APPLICATION->ShowPanel(); ?>
	</div>
	<section id="wrapper">
		<header id="header">
			<div class="inner">
				<div id="logo">
					<a href="/" title="Site name">
					</a>
				</div>
				<? $APPLICATION->IncludeComponent(
					"bitrix:catalog.search",
					"header_search",
					array(
						"ACTION_VARIABLE" => "action",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"BASKET_URL" => "/personal/basket.php",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "N",
						"CONVERT_CURRENCY" => "N",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_COMPARE" => "N",
						"DISPLAY_TOP_PAGER" => "N",
						"ELEMENT_SORT_FIELD" => "sort",
						"ELEMENT_SORT_FIELD2" => "id",
						"ELEMENT_SORT_ORDER" => "asc",
						"ELEMENT_SORT_ORDER2" => "desc",
						"HIDE_NOT_AVAILABLE" => "N",
						"HIDE_NOT_AVAILABLE_OFFERS" => "N",
						"IBLOCK_ID" => "2",
						"IBLOCK_TYPE" => "Catalog",
						"LINE_ELEMENT_COUNT" => "3",
						"NO_WORD_LOGIC" => "N",
						"OFFERS_CART_PROPERTIES" => array(),
						"OFFERS_FIELD_CODE" => array("", ""),
						"OFFERS_LIMIT" => "5",
						"OFFERS_PROPERTY_CODE" => array("", ""),
						"OFFERS_SORT_FIELD" => "sort",
						"OFFERS_SORT_FIELD2" => "id",
						"OFFERS_SORT_ORDER" => "asc",
						"OFFERS_SORT_ORDER2" => "desc",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Товары",
						"PAGE_ELEMENT_COUNT" => "30",
						"PRICE_CODE" => array(),
						"PRICE_VAT_INCLUDE" => "Y",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRODUCT_PROPERTIES" => array(),
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"PROPERTY_CODE" => array("NAZVANIE", "ARTICLE", ""),
						"RESTART" => "N",
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"SECTION_URL" => "",
						"SHOW_PRICE_COUNT" => "1",
						"USE_LANGUAGE_GUESS" => "Y",
						"USE_PRICE_COUNT" => "N",
						"USE_PRODUCT_QUANTITY" => "N",
						"USE_SEARCH_RESULT_ORDER" => "N",
						"USE_TITLE_RANK" => "N"
					)
				); ?>
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
					<div class="bag">
						<div>
							<? $APPLICATION->IncludeComponent(
								"bitrix:sale.basket.basket.line",
								"",
								array(
									"HIDE_ON_BASKET_PAGES" => "Y",
									"PATH_TO_AUTHORIZE" => "",
									"PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
									"PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
									"PATH_TO_PERSONAL" => SITE_DIR . "personal/",
									"PATH_TO_PROFILE" => SITE_DIR . "personal/",
									"PATH_TO_REGISTER" => SITE_DIR . "auth/",
									"POSITION_FIXED" => "N",
									"SHOW_AUTHOR" => "Y",
									"SHOW_EMPTY_VALUES" => "Y",
									"SHOW_NUM_PRODUCTS" => "N",
									"SHOW_PERSONAL_LINK" => "N",
									"SHOW_PRODUCTS" => "N",
									"SHOW_REGISTRATION" => "Y",
									"SHOW_TOTAL_PRICE" => "N",
									"COMPONENT_TEMPLATE" => ".default"
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
		<section id="container">
			<div class="inner">
				<? $APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"topNavigate",
					array(
						"COMPONENT_TEMPLATE" => "topNavigate",
						"PATH" => "",
						"SITE_ID" => "s1",
						"START_FROM" => "0"
					),
					false
				); ?>