<?php
/**
 * Компонент редактора
 */

use Bitrix\Main\Loader,
    Bitrix\Main\Application,
    Bitrix\Main\IO\Directory,
    Bitrix\Main\IO\File,
    Bitrix\Main\Localization\Loc;

use Bitrix\Iblock\ElementTable;


class PaintEdit extends \CBitrixComponent
{
    /**
     *  Подключаем языковые файлы
     */

    public function onIncludeComponentLang()
    {
        Loc::loadMessages(__FILE__);
    }

	public function executeComponent()
	{
		Loader::includeModule('iblock');
		$request = Application::getInstance()->getContext()->getRequest();

		$isAjaxRequest = $request->getRequestMethod() == 'POST';

		if ($isAjaxRequest) {
			$this->processAJAX($request);
		} elseif(isset($this->arParams['ELEMENT_ID']) && $this->arParams['ELEMENT_ID'] > 0) {

			$this->arResult = $this->getElement(['ID' => $this->arParams['ELEMENT_ID']]);
		}

        $this->includeComponentTemplate();
	}

    /**
     * Обработка POST-запросов
     *
     * @param $request
     * @return bool
     */
	protected function processAJAX($request)
	{
        $elementID = (int)$this->arParams['ELEMENT_ID'];
		if($elementID > 0)
		{
            $element = $this->getElement(['ID' => $elementID]);
			$passw = $request->get('passw');

			if(!$this->checkPassword($element['CODE'], $passw))
			{
				$this->ajaxResponse(['MESSAGE' => Loc::getMessage('BAD_PASSW')]);
				return false;
			}

			$fileID = $this->storeFile();
			$this->update($request, $fileID, $elementID);
			$this->ajaxResponse(['MESSAGE' => Loc::getMessage('SUCCESS')]);
        } else {

			$fileID = $this->storeFile();
			$elementID = $this->save($request, $fileID);
			$this->ajaxResponse(['MESSAGE' => Loc::getMessage('SUCCESS'), 'ELEMENT_ID' => $elementID]);
		}
	}

    /**
     * Получение элемента для вывода/редактирования
     *
     * @param $filter
     * @return mixed
     */
	protected function getElement($filter)
	{
		return ElementTable::getList([
            "select"    => ["*"],
            "filter"    => $filter,
            "limit"     => 1
        ])->fetch();

	}

	protected function save($request, $fileID)
	{
		if (!$this->arParams['IBLOCK_ID'])
		{
            ShowError(Loc::getMessage('NOT_SET_IBLOCK_ID'));
			return false;
		}

		$oCIBlockElement = new CIBlockElement();

		$result = $oCIBlockElement->add([
			'IBLOCK_ID' 	 => $this->arParams['IBLOCK_ID'],
			'NAME'      	 => md5($request->get('passw')),
			'CODE'			 => md5($request->get('passw')),
			"DETAIL_PICTURE" =>  $fileID
		]);

		if (!$result)
		{
		    return $oCIBlockElement->LAST_ERROR;
            ShowError($oCIBlockElement->LAST_ERROR);
			return false;
		}

		return $result;
	}

    /**
     * Обновление данных существующего элемента
     *
     * @param $request
     * @param $fileID
     * @param $elementID
     * @return bool
     */
	protected function update($request, $fileID, $elementID)
	{
		if (!$this->arParams['IBLOCK_ID'])
		{
            ShowError(Loc::getMessage('NOT_SET_IBLOCK_ID'));
			return false;
		}

		$oCIBlockElement = new CIBlockElement();

		$result = $oCIBlockElement->update(

			$elementID,
			[
				'IBLOCK_ID' 	 => $this->arParams['IBLOCK_ID'],
				"DETAIL_PICTURE" =>  $fileID
			]);

		if (!$result)
		{
            ShowError($oCIBlockElement->LAST_ERROR);
			return false;
		}

		return $result;
	}

    /**
     * Сохранение файла рисунка
     *
     * @return bool
     */
	protected function storeFile()
	{
		if (!$this->arParams['TMP_FOLDER'])
		{
            ShowError(Loc::getMessage('NOT_SET_TMP_FOLDER'));
			return false;
		}

		$path = Application::getDocumentRoot() . $this->arParams['TMP_FOLDER'];

        Directory::createDirectory($path);

		$request = Application::getInstance()->getContext()->getRequest();

		$img = $request->get('canvasFile');
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);

		$fileData = base64_decode($img);
		$fileName = md5("file") . '.png';

        $tmpFilePath = $path . $fileName;

		if(!File::putFileContents($tmpFilePath, $fileData))
		{
			ShowError(Loc::getMessage('ERROR_STORE_FILE'));
			return false;
		}

		return \CFile::MakeFileArray($tmpFilePath);
	}

    /**
     * Возвращаем Json-ответ
     * @param $result
     */
	protected function ajaxResponse($result)
	{
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        header('Content-type: application/json');
        echo \Bitrix\Main\Web\Json::encode($result);
        die();
	}

    /**
     * Проверяем пароль при редактировании
     *
     * @param $storedHash
     * @param $passw
     * @return bool
     */
	private function checkPassword($storedHash, $passw)
	{
		if(!$storedHash || !$passw) return false;

		$passwHash = md5($passw);

		return $storedHash === $passwHash;
	}

}
