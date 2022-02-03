<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
$this->setFrameMode(true);
?>


<div class="goods-inner">
	<? if (!empty($item['IMAGES'])) : ?>
		<div class="goods-slider">
			<ul class="slides">
				<? foreach ($item['IMAGES'][$productTitle] as $img) :?>
					<li><img src="<?= $img ?>" alt=""></li>
				<? endforeach; ?>
			</ul>
			<a href="<?=$item['']?>" class="quick-view various fancybox.ajax" data-fancybox-type="ajax">Быстрый просмотр</a>
		</div>
	<? endif; ?>

	<div class="goods-description">
		<? if ($itemHasDetailUrl) : ?>
			<h3><a href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $productTitle ?>"><?= $productTitle ?></h3></a>
		<? endif; ?>

		<div class="art">
			<?= $item['ARTICLE'][$productTitle] ?>
		</div>

		<div class="cost" data-entity="price-block">
		<?=$price['PRINT_RATIO_PRICE'];?>
		</div>
		<? if (!empty($item['SIZE'])) : ?>
			<div class="sizes">
				<div>размеры:</div>
				<ul>
					<? foreach ($item['SIZE'] as $size) : ?>
						<li><?= $size ?></li>
					<? endforeach; ?>
				</ul>
			</div>
		<? endif; ?>
	</div>
</div>
