<?php

$IBLOCK_ID_art = intval($arResult['ITEM']['IBLOCK_ID']);
$IBLOCK_ID_size = intval($arResult['ITEM']['OFFERS']['0']['IBLOCK_ID']);
if (!CModule::IncludeModule("iblock")) {
    die('iblock module is not included!');
}
if (!empty($IBLOCK_ID_art) && !empty($IBLOCK_ID_size)) {
    $arSort = array("SORT" => "ASC", "NAME" => "ASC");
    $arFilter = array("IBLOCK_ID" => $IBLOCK_ID_art, "ACTIVE" => "Y");
    $obArticle = CIBlockElement::GetList($arSort, $arFilter, false, false, array('PROPERTY_ATRICLE', 'PROPERTY_MORE_PHOTO'));
    $photoId = [];
    $article = [];

    while ($res = $obArticle->GetNext()) {
        $article[$res['NAME']] = $res['PROPERTY_ATRICLE_VALUE'];
        if (empty($photoId[$res['NAME']]['@ID'])) {
            $photoId[$res['NAME']]['@ID'] = intval($res['PROPERTY_MORE_PHOTO_VALUE']);
            continue;
        }
        $photoId[$res['NAME']]['@ID'] .= ',' . intval($res['PROPERTY_MORE_PHOTO_VALUE']);
    }
    $arResult['ITEM']['ARTICLE'] = $article;
    unset($article);

    $arFilter = array("IBLOCK_ID" => $IBLOCK_ID_size, "ACTIVE" => "Y");
    $obSize = CIBlockElement::GetList($arSort, $arFilter, false, false, array('PROPERTY_SIZE'));
    $size = [];
    while ($res = $obSize->GetNext()) {
        $size[$res['PROPERTY_SIZE_VALUE']] = intval($res['PROPERTY_SIZE_VALUE']);
    }

    $arResult['ITEM']['SIZE'] = $size;
    unset($size);

    $url = [];
    $arSort = array('ID' => 'ASC');
    foreach ($photoId as $key => $ph) {
        $photo = CFile::GetList($arSort, $ph);
        while ($res = $photo->GetNext()) {
            $url[$key][] = "/" . COption::GetOptionString("main", "upload_dir", "upload") . "/" . $res["SUBDIR"] . "/" . $res["FILE_NAME"];
        }
    }
    $arResult['ITEM']['IMAGES'] = $url;
    unset($photoId);
    unset($url);
}
