<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<nav id="navi">
		<ul>
			<?foreach ($arResult as $arItem) : ?>
				<? if ($arItem["SELECTED"]) : ?>
					<li>
						<a href="<?= $arItem["LINK"] ?>" class="selected"><?= $arItem["TEXT"] ?></a>
					</li>
				<? else : ?>
					<li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
				<? endif ?>
			<? endforeach ?>
		</ul>
	<? endif ?>