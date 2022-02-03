<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>

	<div class="company-menu">
		<h3>Компания</h3>
		<ul>
			<? for ($i = 0; $i < count($arResult); $i++) : ?>
				<? if ($i < round(count($arResult) / 2)) : ?>
					<li><a href="<?= $arResult[$i]["LINK"] ?>"><?= $arResult[$i]["TEXT"] ?></a></li>
				<? endif ?>
			<? endfor ?>
		</ul>
		<ul>
			<? for ($i = round(count($arResult) / 2); $i < count($arResult); $i++) : ?>
				<li><a href="<?= $arResult[$i]["LINK"] ?>"><?= $arResult[$i]["TEXT"] ?></a></li>
			<? endfor ?>
		</ul>
		<? endif ?>
	</div>