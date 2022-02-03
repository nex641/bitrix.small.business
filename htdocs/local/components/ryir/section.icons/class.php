<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Loader,
    \Bitrix\Main\Application;

class SectionIcon extends CBitrixComponent
{
    private $_request;

    /**
     * Проверка наличия модулей требуемых для работы компонента
     * @return bool
     * @throws Exception
     */
    private function _checkModules()
    {
        if (
            !Loader::includeModule('iblock')
            || !Loader::includeModule('catalog')
        ) {
            throw new \Exception('Не загружены модули необходимые для работы модуля');
        }

        return true;
    }

    /**
     * Обертка над глобальной переменной
     * @return CAllMain|CMain
     */
    private function _app()
    {
        global $APPLICATION;
        return $APPLICATION;
    }

    /**
     * Обертка над глобальной переменной
     * @return CAllUser|CUser
     */
    private function _user()
    {
        global $USER;
        return $USER;
    }

    /**
     * Подготовка параметров компонента
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($arParams)
    {
        if (!isset($arParams["CACHE_TIME"])) {
            $arParams["CACHE_TIME"] = 36000000;
        }
        $arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
        $arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
        $arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
        $arParams["SECTION_CODE"] = trim($arParams["SECTION_CODE"]);
        $arParams["SECTION_URL"] = trim($arParams["SECTION_URL"]);
        $arParams["TOP_DEPTH"] = intval($arParams["TOP_DEPTH"]);

        if ($arParams["TOP_DEPTH"] <= 0) {
            $arParams["TOP_DEPTH"] = 2;
        }
        $arParams["ADD_SECTIONS_CHAIN"] = $arParams["ADD_SECTIONS_CHAIN"] != "N"; //Turn on by default
        $arParams["CACHE_FILTER"] = isset($arParams["CACHE_FILTER"]) && $arParams["CACHE_FILTER"] == "Y";
        if (!$arParams["CACHE_FILTER"] && !empty($arrFilter))
            $arParams["CACHE_TIME"] = 0;

        $arParams['SHOW_TITLE'] = ($arParams['SHOW_TITLE'] ?? 'N') === 'Y';

        $arResult["SECTIONS"] = array();

        return $arParams;
    }
    protected function filter($arParams)
    {
        if (empty($arParams["FILTER_NAME"]) || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"])) {
            $arrFilter = array();
        } else {
            global ${$arParams["FILTER_NAME"]};
            $arrFilter = ${$arParams["FILTER_NAME"]};
            if (!is_array($arrFilter)) {
                $arrFilter = array();
            }
        }
        $arResult["SECTION"] = false;
        if ($arParams["SECTION_ID"] > 0) {
            $arFilter["ID"] = $arParams["SECTION_ID"];
            $rsSections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
            $rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
            $arResult["SECTION"] = $rsSections->GetNext();
        } elseif ('' != $arParams["SECTION_CODE"]) {
            $arFilter["=CODE"] = $arParams["SECTION_CODE"];
            $rsSections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
            $rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
            $arResult["SECTION"] = $rsSections->GetNext();
        }

        if (is_array($arResult["SECTION"])) {
            $arResult["SECTION"]["~ELEMENT_CNT"] = null;
            $arResult["SECTION"]["ELEMENT_CNT"] = null;
            unset($arFilter["ID"]);
            unset($arFilter["=CODE"]);
            $arFilter["LEFT_MARGIN"] = $arResult["SECTION"]["LEFT_MARGIN"] + 1;
            $arFilter["RIGHT_MARGIN"] = $arResult["SECTION"]["RIGHT_MARGIN"];
            $arFilter["<=" . "DEPTH_LEVEL"] = $arResult["SECTION"]["DEPTH_LEVEL"] + $arParams["TOP_DEPTH"];

            $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult["SECTION"]["IBLOCK_ID"], $arResult["SECTION"]["ID"]);
            $arResult["SECTION"]["IPROPERTY_VALUES"] = $ipropValues->getValues();

            $arResult["SECTION"]["PATH"] = array();
            $rsPath = CIBlockSection::GetNavChain(
                $arResult["SECTION"]["IBLOCK_ID"],
                $arResult["SECTION"]["ID"],
                array(
                    "ID", "CODE", "XML_ID", "EXTERNAL_ID", "IBLOCK_ID",
                    "IBLOCK_SECTION_ID", "SORT", "NAME", "ACTIVE",
                    "DEPTH_LEVEL", "SECTION_PAGE_URL"
                )
            );
            $rsPath->SetUrlTemplates("", $arParams["SECTION_URL"]);
            while ($arPath = $rsPath->GetNext()) {
                if ($arParams["ADD_SECTIONS_CHAIN"]) {
                    $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"], $arPath["ID"]);
                    $arPath["IPROPERTY_VALUES"] = $ipropValues->getValues();
                }
                $arResult["SECTION"]["PATH"][] = $arPath;
            }
        } else {
            $arResult["SECTION"] = array("ID" => 0, "DEPTH_LEVEL" => 0);
            $arFilter["<=" . "DEPTH_LEVEL"] = $arParams["TOP_DEPTH"];
        }
        $intSectionDepth = $this->arResult["SECTION"]['DEPTH_LEVEL'];

        $sectionFilter = array_merge($arrFilter, $arFilter);
        return $sectionFilter;
    }
    protected function select($arParams)
    {
        $arSelect = array();

        if (!empty($arParams["SECTION_FIELDS"]) && is_array($arParams["SECTION_FIELDS"])) {
            foreach ($arParams["SECTION_FIELDS"] as &$field) {
                if (!empty($field) && is_string($field))
                    $arSelect[] = $field;
            }
            unset($field);
        }
        if (!empty($arSelect)) {
            $arSelect = array_merge(
                $arSelect,
                array(
                    "ID",
                    "NAME",
                    "LEFT_MARGIN",
                    "RIGHT_MARGIN",
                    "DEPTH_LEVEL",
                    "IBLOCK_ID",
                    "IBLOCK_SECTION_ID",
                    "LIST_PAGE_URL",
                    "SECTION_PAGE_URL"
                )
            );
        }
        if (!empty($arParams["SECTION_USER_FIELDS"]) && is_array($arParams["SECTION_USER_FIELDS"])) {
            foreach ($arParams["SECTION_USER_FIELDS"] as &$field) {
                if (is_string($field) && preg_match("/^UF_/", $field))
                    $arSelect[] = $field;
            }
            unset($field);
        }
        $arSelect = array_unique($arSelect);
        return $arSelect;
    }

    protected function isPicture($arSelect): bool
    {
        return $boolPicture = empty($arSelect) || in_array('PICTURE', $arSelect);
    }

    protected function sort()
    {
        $arSort = array();
        if (!empty($this->arParams['CUSTOM_SECTION_SORT']) && is_array($this->arParams['CUSTOM_SECTION_SORT'])) {
            foreach ($this->arParams['CUSTOM_SECTION_SORT'] as $field => $value) {
                if (!is_string($value)) {
                    continue;
                }
                $field = strtoupper($field);
                if (isset($arSort[$field])) {
                    continue;
                }
                if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls)?$/i', $value)) {
                    continue;
                }
                $arSort[$field] = $value;
            }
            unset($field, $value);
        }

        if (empty($arSort)) {
            $arSort = array(
                "LEFT_MARGIN" => "ASC",
            );
        }
        return $arSort;
    }

    private function cache()
    {
        // $this->setResultCacheKeys(array(
        //     "SECTIONS_COUNT",
        //     "SECTION",
        // ));
        $this->onPrepareComponentParams($this->arParams);
    }

    /**
     * Точка входа в компонент
     * Должна содержать только последовательность вызовов вспомогательых ф-ий и минимум логики
     * всю логику стараемся разносить по классам и методам 
     */
    public function executeComponent()
    {
        $this->_checkModules();

        $this->_request = Application::getInstance()->getContext()->getRequest();
        $intSectionDepth = $this->arResult["SECTION"]['DEPTH_LEVEL'];
        $arParams = $this->onPrepareComponentParams($this->arParams);
        $arSort = $this->sort();
        $sectionFilter = $this->filter($arParams);
        $arSelect = $this->select($arParams);

        $rsSections = CIBlockSection::GetList($arSort, $sectionFilter, false, $arSelect);
        $rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
        while ($arSection = $rsSections->GetNext()) {
            \Bitrix\Iblock\InheritedProperty\SectionValues::queue($arSection["IBLOCK_ID"], $arSection["ID"]);
            $arSection['RELATIVE_DEPTH_LEVEL'] = $arSection['DEPTH_LEVEL'] - $intSectionDepth;

            $arButtons = CIBlock::GetPanelButtons(
                $arSection["IBLOCK_ID"],
                0,
                $arSection["ID"],
                array("SESSID" => false, "CATALOG" => true)
            );
            $arSection["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];
            $arSection["DELETE_LINK"] = $arButtons["edit"]["delete_section"]["ACTION_URL"];

            $arSection["~ELEMENT_CNT"] = null;
            $arSection["ELEMENT_CNT"] = null;
            $arSection['ELEMENT_CNT_TITLE'] = '';
            $arResult["SECTIONS"][] = $arSection;
        }

        foreach ($arResult["SECTIONS"] as &$arSection) {
            $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arSection["IBLOCK_ID"], $arSection["ID"]);
            $arSection["IPROPERTY_VALUES"] = $ipropValues->getValues();

            if ($this->isPicture($this->select($this->arParams))) {
                \Bitrix\Iblock\Component\Tools::getFieldImageData(
                    $arSection,
                    array('PICTURE'),
                    \Bitrix\Iblock\Component\Tools::IPROPERTY_ENTITY_SECTION,
                    'IPROPERTY_VALUES'
                );
            }
        }
        unset($arSection);

        $arResult["SECTIONS_COUNT"] = count($arResult["SECTIONS"]);
        $this->arResult = $arResult;

        $this->includeComponentTemplate();
    }
}
