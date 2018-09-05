<?php
/**
 *
 * Комплексный компонент редактора картинок.
 *
 */

use Bitrix\Main,
    Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\Context;
use CComponentEngine;

class Draw extends \CBitrixComponent
{

    protected $IBLOCK_ID = 1;
    protected $TMP_FOLDER = '/uploads/temp/';

    /**
     * Подготавливаем входные параметры
     * @param $params
     * @return array
     * @internal param array $arParams
     */

    public function onPrepareComponentParams($params)
    {
        $request = Context::getCurrent()->getRequest();

        $result = array(
            'IBLOCK_ID' => ($params['IBLOCK_ID'])? intval($params['IBLOCK_ID']) : $this->IBLOCK_ID,
            'TMP_FOLDER' => ($params['TMP_FOLDER'])? $params['TMP_FOLDER'] : $this->TMP_FOLDER,
            'ACTION' => $request['ACTION'],
            'ELEMENT_ID' => $request['ELEMENT_ID'],
            'SEF_URL_TEMPLATES' => $params['SEF_URL_TEMPLATES']
        );

        return $result;
    }

    /**
     *  Подключаем языковые файлы
     */

    public function onIncludeComponentLang()
    {
        Loc::loadMessages(__FILE__);
    }


    public function executeComponent()
    {
        $arDefaultVariableAliases = [];
        $arDefaultUrlTemplates404 = [];

        $arComponentVariables = [
            "IBLOCK_ID",
            "ELEMENT_ID",
            "TMP_FOLDER",
            "ACTION"
        ];

        $SEF_FOLDER = "/";
        $componentPage = "list";
        $arVariables = [];
        $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $this->arParams["SEF_URL_TEMPLATES"]);

        $engine = new CComponentEngine($this);

        if (Loader::includeModule('iblock'))
        {
            $engine->addGreedyPart("#SECTION_CODE_PATH#");
            $engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
        }

        $componentPage = $engine->guessComponentPath(
            $SEF_FOLDER,
            $arUrlTemplates,
            $arVariables
        );


        $arVariableAliases = CComponentEngine::MakeComponentVariableAliases(
            $arDefaultVariableAliases,
            $this->arParams["VARIABLE_ALIASES"]
        );

        CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

        $this->arResult = [
            "VARIABLES" => $arVariables,
            "PARAMS" => $this->arParams
        ];

        $this->IncludeComponentTemplate($componentPage);
    }
}