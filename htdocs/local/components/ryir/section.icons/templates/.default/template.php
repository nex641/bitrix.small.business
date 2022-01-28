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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
//самопис переделать
?><section class="categories">
	<div class="inner">
		<? if (0 < $arResult["SECTIONS_COUNT"]) : ?>
			<? foreach ($arResult['SECTIONS'] as &$arSection) : ?>
				<div class="cat-item">
					<a class="first" href="<?=$arSection['SECTION_PAGE_URL'];?>">
						<img src="<?= $arSection['PICTURE']['SRC']; ?>" alt="">
						<span class="cat-title"><?= $arSection['NAME']; ?></span>
					</a>
					<a class="last" href="<?=$arSection['SECTION_PAGE_URL'];?>">
						<img src="<?= $arSection['PICTURE']['SRC']; ?>" alt="">
						<span class="cat-title"><?= $arSection['NAME']; ?></span>
					</a>
				</div>
			<? endforeach; ?>
		<? endif; ?>
	</div>
</section>