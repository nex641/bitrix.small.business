<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!-- start footer -->
<footer id="footer">
	<div class="inner">
		<div class="footer-phones">
			<div class="footer-phone">
				<span class="number">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_TEMPLATE_PATH . "/includes/footer_phone.php",
						)
					); ?></span>
				<span class="label-phone">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_TEMPLATE_PATH . "/includes/footer_time.php",
						)
					); ?>
				</span>
			</div>

			<div class="footer-phone">
				<span class="number">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_TEMPLATE_PATH . "/includes/footer_secondphone.php",
						)
					); ?>
				</span>
				<span class="label-phone">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_TEMPLATE_PATH . "/includes/footer_secondtime.php",
						)
					); ?>
				</span>
			</div>
		</div>

		<? $APPLICATION->IncludeComponent(
			"bitrix:menu",
			"bottom_menu_multi",
			array(
				"COMPONENT_TEMPLATE" => "bottom_menu_multi",
				"ROOT_MENU_TYPE" => "bottom",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_USE_GROUPS" => "N",
				"MENU_CACHE_GET_VARS" => array(),
				"MAX_LEVEL" => "1",
				"CHILD_MENU_TYPE" => "",
				"USE_EXT" => "N",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "Y"
			),
			false
		); ?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:menu",
			"bottom_menu",
			array(
				"COMPONENT_TEMPLATE" => "bottom_menu",
				"ROOT_MENU_TYPE" => "bottom",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_USE_GROUPS" => "N",
				"MENU_CACHE_GET_VARS" => array(),
				"MAX_LEVEL" => "1",
				"CHILD_MENU_TYPE" => "",
				"USE_EXT" => "Y",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "Y"
			),
			false
		); ?>

		<? $APPLICATION->IncludeComponent(
			"bitrix:eshop.socnet.links",
			"template1",
			array(
				"FACEBOOK" => "акуаку",
				"GOOGLE" => "",
				"INSTAGRAM" => "",
				"TWITTER" => "",
				"VKONTAKTE" => "",
				"COMPONENT_TEMPLATE" => "template1"
			),
			false
		); ?>

		<? $APPLICATION->IncludeComponent(
			"bitrix:sender.subscribe",
			"subscribe",
			array(
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "N",
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "N",
				"CONFIRMATION" => "Y",
				"HIDE_MAILINGS" => "N",
				"SET_TITLE" => "N",
				"SHOW_HIDDEN" => "N",
				"USER_CONSENT" => "N",
				"USER_CONSENT_ID" => "0",
				"USER_CONSENT_IS_CHECKED" => "Y",
				"USER_CONSENT_IS_LOADED" => "N",
				"USE_PERSONALIZATION" => "N",
				"COMPONENT_TEMPLATE" => "subscribe"
			),
			false
		); ?>
		<p class="copyright">© 2021 Интернет-магазин женской одежды «Donna Saggia». Все права защищены</p>
	</div>
</footer>
</section>
</body>

</html>