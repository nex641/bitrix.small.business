<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class Engxam extends \CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable
{
    /** @var dictionary */
    protected $dictionary;

    public function configureActions()
    {
        //если действия не нужно конфигурировать, то пишем просто так. И будет конфиг по умолчанию 
        return [];
    }

    public function onPrepareComponentParams($arParams)
    {
        if (empty($this->dictionary)) {
            $this->dictionary = include_once('dictionary.php');
        }

        //подготовка параметров
        //Этот код **будет** выполняться при запуске аяксовых-действий
    }

    public function executeComponent()
    {
        //Внимание! Этот код **не будет** выполняться при запуске аяксовых-действий
    }

    // public function translateAction($word)
    // {
    //     foreach ($this->dictionary as $value) {
    //        if ($value[$word]) {

    //        }
    //     }
    // }
    public function listAction()
    {
        $id = [];

        foreach ($this->dictionary as $value) {
            $id[] = $value['id'];
        }
        return $id;
    }

    public function wordAction($id, $lang)
    {
        foreach ($this->dictionary as $value) {
            if ($value['id'] == $id) {
                return $value[$lang];
            }
        }
        
    }
}
