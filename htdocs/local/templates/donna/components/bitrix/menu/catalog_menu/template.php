<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<div class="side-menu">
		<ul>
			<? foreach ($arResult as $arItem) :
				if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
					continue;
				}

				$class = '';
				($arItem['SELECTED']) ? $class = 'current' : $class = '';

				if (!isset($arItem['subitem'])) : ?>
					<? if (empty($arItem['PARAMS'])) {
						continue;
					} ?>
					<li class="<?= $class; ?>"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
				<? else : ?>
					<li class="<?= $class; ?>"><a href="<?= $arItem["LINK"]; ?>" ><?= $arItem["TEXT"]; ?></a>
						<ul class="<?(!$arItem['SELECTED']) ? print 'drop' : print '';?>">
							<? foreach ($arItem['subitem'] as $subItems) : ?>
								<li>
									<a href="<?= $subItems["LINK"]; ?>"><?= $subItems["TEXT"]; ?></a>
								</li>
							<? endforeach; ?>
						</ul>
					</li>
				<? endif ?>
			<? endforeach ?>
		<? endif ?>
		</ul>
		<ul>
			<? foreach ($arResult as $arItem) : ?>
				<? if (empty($arItem['PARAMS'])) : ?>
					<li>
						<a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
					</li>
				<? endif; ?>
			<? endforeach; ?>
		</ul>
	</div>