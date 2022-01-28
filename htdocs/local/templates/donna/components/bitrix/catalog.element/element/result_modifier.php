<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Loader;
use \Bitrix\Highloadblock as HL;

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */



$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$HighloadProperty = $arResult['PROPERTIES']['COLOR'];
$tableName = $HighloadProperty['USER_TYPE_SETTINGS']['TABLE_NAME'];
$arSort = ["ID" => "ASC"];
if (Loader::IncludeModule('highloadblock') && !empty($tableName) && !empty($HighloadProperty["VALUE"])) {
    $hlblock = HL\HighloadBlockTable::getRow([
        'filter' => [
            '=TABLE_NAME' => $tableName
        ],
    ]);

    if ($hlblock) {
        $entity      = HL\HighloadBlockTable::compileEntity($hlblock);
        $entityClass = $entity->getDataClass();

        $arRecords = $entityClass::getList([
            'filter' => [
                'UF_XML_ID' => $HighloadProperty["VALUE"]
            ],
        ]);
        foreach ($arRecords as $record) {
            $arColor = [
                'ID'                  => $record['ID'],
                'UF_NAME'             => $record['UF_NAME'],
            ];
            $arResult['PROPERTIES']['COLOR']['UF_VALUE'] = $arColor['UF_NAME'];
        }
    }
}
$rsFile = CFile::GetByID($arResult["PREVIEW_PICTURE"]['ID']);
$arFile = $rsFile->Fetch();
$arResult["PREVIEW_PICTURE"]['SRC'] = "/" . COption::GetOptionString("main", "upload_dir", "upload") . "/" . $arFile['SUBDIR'] . "/" . $arFile['FILE_NAME'];
unset($arFile);
foreach ($arResult['OFFERS'] as $value) {
    $arItem[$value['PROPERTIES']['SIZE']['VALUE_ENUM'][0]] = ["BUY_URL" => $value['BUY_URL'], "ADD_URL" => $value['ADD_URL']];
}
$arResult['OFFERS']['PROPERTIES']['SIZE']['MAP'] = $arItem;
unset($arItem);

