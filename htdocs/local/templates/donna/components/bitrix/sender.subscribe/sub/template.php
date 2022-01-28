<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$buttonId = $this->randString();
?>
<div class="subscribe-section">
	<form action="" method="post">
		<fieldset>
			<div class="subscribe">
				<input type="text" name="subscribe-input" placeholder="Подпишитесь на новости" value="" />
				<input type="submit" name="submit" value="" />
			</div>
		</fieldset>
	</form>
</div>