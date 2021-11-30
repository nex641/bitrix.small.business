<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);

if (is_array($arResult["SOCSERV"]) && !empty($arResult["SOCSERV"])) {
?>
	<div class="social">
		<h3>Социальные сети</h3>
		<div class="icons">
			<? foreach ($arResult["SOCSERV"] as $socserv) : ?>
				<a class="<?= htmlspecialcharsbx($socserv["CLASS"]) ?> bx-socialsidebar-icon" href="<?= htmlspecialcharsbx($socserv["LINK"]) ?>"></a>
			<? endforeach ?>
		</div>
	</div>
<?
}
?>