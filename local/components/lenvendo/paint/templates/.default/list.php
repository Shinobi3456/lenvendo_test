<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php $APPLICATION->SetTitle("Список картинок"); ?>
<?php $APPLICATION->IncludeComponent(
	'lenvendo:paint.list',
	'',
	[
		'IBLOCK_ID'		         => $arParams["IBLOCK_ID"],
		'SORT'			         => ["created" => "DESC"],
        'SEF_PAGE_LIST' => $arParams["SEF_URL_TEMPLATES"]['list']
	]
);?>