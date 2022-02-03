<?

use Bitrix\Main\Grid\Panel\Snippet\Onchange;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get" class="smartfilter">
	<? foreach ($arResult["HIDDEN"] as $item) : ?>
		<input type="hidden" name="<? echo $item["CONTROL_NAME"] ?>" id="<? echo $item["CONTROL_ID"] ?>" value="<? echo $item["HTML_VALUE"] ?>" />
	<? endforeach; ?>
	<div class="filter" data-role="bx_filter_block">
		<? foreach ($arResult['ITEMS'] as $key => $item) :
			if (!isset($item['DISPLAY_TYPE'])) {
				$item['DISPLAY_TYPE'] = 'A';
			} ?>
			<script>
				new top.BX.CHint({
					parent: top.BX("item_title_hint_<? echo $item["ID"] ?>"),
					show_timeout: 10,
					hide_timeout: 200,
					dx: 2,
					preventHide: true,
					min_width: 250,
					hint: '<?= CUtil::JSEscape($item["FILTER_HINT"]) ?>'
				});
			</script>
			<? switch ($item['DISPLAY_TYPE']):
				case "F": ?>
					<div class="filter-wrap">
						<? if (isset($item['NAME'])) : ?>
							<div class="title-filter"><?= $item['NAME']; ?></div>
						<? endif; ?>
						<ul>
							<? foreach ($item['VALUES'] as $value) : ?>
								<li>
									<input type="checkbox" id="<?= $value['CONTROL_ID']; ?>" name="<?= $value['CONTROL_NAME'] ?>" value="<?= 'Y' ?>" onclick="smartFilter.click(this)">
									<label for="<?= $value['CONTROL_ID']; ?>"><?= $value['VALUE']; ?></label>
								</li>
							<? endforeach; ?>
						</ul>
					</div>
					<? break; ?>
				<?
				case "P": ?>
					<div class="filter-wrap">
						<? if (isset($item['NAME'])) : ?>
							<div class="title-filter"><?= $item['NAME']; ?></div>
						<? endif; ?>
						<? if (isset($item['VALUES'])) {
							$border =  floor((count($item['VALUES']) + 1) / 2);
							$i = 1;
						?>
							<ul class="filter-size">
								<? foreach ($item['VALUES'] as $value) {
									if ($i <= $border) { ?>
										<li><input type="checkbox" id="<?= $value['CONTROL_ID'] ?>" name="<?= $value['CONTROL_NAME'] ?>" value="<?= $value['VALUE'] ?>" onclick="smartFilter.click(this)"><label for="<?= $value['CONTROL_ID'] ?>"><?= $value['VALUE'] ?></label></li>
									<?
									}
									if ($i == $border) { ?>
							</ul>
							<ul class="filter-size last"><?
														}
														if ($i > $border) { ?>
								<li><input type="checkbox" id="<?= $value['CONTROL_ID'] ?>" name="<?= $value['CONTROL_NAME'] ?>" value="<?= $value['VALUE'] ?>" onclick="smartFilter.click(this)"><label for="<?= $value['CONTROL_NAME'] ?>"><?= $value['VALUE'] ?></label></li>
						<?
														}
														$i++;
													}
						?>
							</ul><?
								}
									?>
					</div>
					<? break; ?>
				<?
				case "G": ?>
					<div class="filter-wrap">
						<? if (isset($item['NAME'])) : ?>
							<div class="title-filter"><?= $item['NAME']; ?></div>
						<? endif; ?>

						<ul class="color-filter">
							<? foreach ($item['VALUES'] as $key => $ar) : ?>
								<li class="">
									<input style="display: none" type="checkbox" name="<?= $ar["CONTROL_NAME"] ?>" id="<?= $ar["CONTROL_ID"] ?>" value="<?= $ar["HTML_VALUE"] ?>" <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?> onchange="smartFilter.keyup(this)" />
									<?
									$class = "";
									if ($ar["CHECKED"])
										$class .= " active";
									if ($ar["DISABLED"])
										$class .= "";
									?>
									<!-- input.checked = !input.checked; input.onchange(); -->
									<span style="background-color: <?= "#" . $key ?>" class="bx-filter-param-span <?= $class ?>" onclick="let smart = (BX('<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')); smart.checked = !smart.checked; smart.onchange();"></span>
								</li>
							<? endforeach; ?>
						</ul>
					</div>
					<? break; ?>
				<?
				case "A": ?>
					<div class="filter-wrap">
						<div class="title-filter">Цена, руб</div>
						<div id="slider-range"></div>
						<div class="range-min">
							<input class="btn btn-themes" type="text" id="<? echo $item["VALUES"]["MIN"]["CONTROL_ID"] ?>" name="<? echo $item["VALUES"]["MIN"]["CONTROL_NAME"] ?>" value="<?= $item['VALUES']['MIN']['VALUE']; ?>" onkeyup="smartFilter.keyup(this)" />
						</div>
						<div class="range-max">
							<input class="btn btn-themes" type="text" id="<? echo $item["VALUES"]["MAX"]["CONTROL_ID"] ?>" name="<? echo $item["VALUES"]["MAX"]["CONTROL_NAME"] ?>" value="<?= $item['VALUES']['MAX']['VALUE']; ?>" onkeyup="smartFilter.keyup(this)" />
						</div>
						<input class="choose" type="submit" id="set_filter" name="set_filter" value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>" />
						<div class="result" onclick="smartFilter.hideFilterProps(this)">
							<a href="<?= $arResult["FILTER_URL"] ?>" class="" id="set_filter" target=""><? echo "Найдено: " . intval($arResult["ELEMENT_COUNT"]); ?></a>
						</div>
					</div>
					<script>
						jQuery(document).ready(function() {
							$("#slider-range").slider({
								range: true,
								min: <?= $item['VALUES']['MIN']['VALUE']; ?>,
								max: <?= $item['VALUES']['MAX']['VALUE']; ?>,
								values: [<?= $item['VALUES']['MIN']['VALUE']; ?>, <?= $item['VALUES']['MAX']['VALUE']; ?>],
								slide: function(event, ui) {
									$(".range-min").text(ui.values[0]);
									$(".range-max").text(ui.values[1]);
								}
							});
							$(".range-min").text($("#slider-range").slider("values", 0));
							$(".range-max").text($("#slider-range").slider("values", 1));
							$(".result").on("click", function() {
								jQuery(".result").fadeOut();
							});
							$(".result").on("click", function() {
								jQuery(".result").fadeOut();
							});
						});
					</script>
					<? break; ?>
			<? endswitch; ?>
		<? endforeach; ?>
	</div>
</form>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<? echo CUtil::JSEscape($arResult["FORM_ACTION"]) ?>', '<?= CUtil::JSEscape($arParams["FILTER_VIEW_MODE"]) ?>', <?= CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"]) ?>);
</script>