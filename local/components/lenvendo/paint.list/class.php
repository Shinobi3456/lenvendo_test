<?php
/**
 * Компонент для вывода списка рисунков.
 */

use Bitrix\Main\Loader;

class GetElements extends \CBitrixComponent
{

    /**
     * Получить список существующих рисунков.
     *
     * @param array $sort
     * @param $filter
     * @param bool $count
     * @return array
     */

    private function getList($sort = ["SORT" => "ASC"], $filter, $count = false)
    {
        $NavStartParams = false;

        if($count) $NavStartParams = ["nTopCount" => $count];
        $CDBResult = CIBlockElement::GetList($sort, $filter, false, $NavStartParams, []);

        $result = [];
        while ($temp = $CDBResult->GetNextElement()) {
            $result[] = array_merge($temp->GetFields(), ['PROPERTIES' => $temp->GetProperties()]);
        }

        return $result;
    }

    /**
     * @return array
     */
    public function executeComponent()
    {
        Loader::includeModule('iblock');

        $this->arResult["ELEMENTS"] = $this->getList($this->arParams["SORT"], ["IBLOCK_ID" => $this->arParams["IBLOCK_ID"]], $this->arParams["COUNT"]);

        $this->includeComponentTemplate();

        return $this->arResult;
    }

}
