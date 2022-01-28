<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arItems = [];

if (!empty($arResult))
{
    foreach ($arResult as $key => $item)
    if ($item['DEPTH_LEVEL'] === 1)
    {
        $arItems[] = $item; 
    }
    else {
        $arItems[end(array_keys($arItems))]['subitem'][] = $item;
    }
}
$arResult = $arItems;