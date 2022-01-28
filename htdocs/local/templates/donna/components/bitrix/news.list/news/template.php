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
$this->setFrameMode(true);
?>
<section class="news">
	<? if ($arResult['ITEMS']) : ?>
		<div class="inner">
			<div class="title-section"><?=$arResult['NAME']?></div>
			<? foreach ($arResult["ITEMS"] as $arItem) : ?>
				<div class="news-item">
					<div class="news-image">
						<a href="#"> <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'];?>" alt=""></a>
					</div>
					<div class="news-description">
						<div class="date"><?= $arItem['TIMESTAMP_X'] ?></div>
						<h3><a href="#"><?= $arItem['PREVIEW_TEXT'];?></a></h3>
						<p><?=$arItem['DETAIL_TEXT'];?></p>
						<a class="more" href="#">Подробнее..</a>
					</div>
				</div>
			<? endforeach; ?>
		<? endif; ?>
		</div>
</section>