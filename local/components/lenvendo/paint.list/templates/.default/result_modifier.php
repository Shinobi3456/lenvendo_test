<?php

$arResult["LIST_URL"] = '/'.$arParams["SEF_PAGE_LIST"];

$result = [];
foreach ($arResult["ELEMENTS"] as $element) {
	$file = CFile::ResizeImageGet($element['DETAIL_PICTURE'], ['width' =>  800, 'height' => 800], BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$element['DETAIL_PICTURE_SRC'] = $file['src'];
	$result[] = $element;
}


$arResult["ELEMENTS"] = $result;