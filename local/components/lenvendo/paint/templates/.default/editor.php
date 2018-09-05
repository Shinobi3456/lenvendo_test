<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php $APPLICATION->SetTitle("Редактор"); ?>
<?php

$params = [
    'AJAX_MODE' 	=> 'Y',
    'IBLOCK_ID'		=> $arParams["IBLOCK_ID"],
    'TMP_FOLDER'	=> $arParams["TMP_FOLDER"],
];

if((int)$arResult["VARIABLES"]["ELEMENT_ID"]>0){
    $params["ELEMENT_ID"] = $arResult["VARIABLES"]["ELEMENT_ID"];
}

$APPLICATION->IncludeComponent(
	'lenvendo:paint.editor',
	'',
    $params
);

?>