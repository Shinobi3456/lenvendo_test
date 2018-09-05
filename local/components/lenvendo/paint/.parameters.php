<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
    "GROUPS" => array(
    ),
    "PARAMETERS" => array(
        "AJAX_MODE" => array(),

		"IBLOCK_ID" => [
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_ID"),
			"TYPE" => "INT",
			"DEFAULT" => '',
			"REFRESH" => "Y",
		],
		"TMP_FOLDER" => [
			"PARENT" => "BASE",
			"NAME" => GetMessage("TMP_FOLDER"),
			"TYPE" => "STRING",
			"DEFAULT" => "/upload/tmp/",
		],
        "SEF_MODE" => Array(
            "list" => array(
                "NAME" => GetMessage("T_IBLOCK_SEF_PAGE_LIST"),
                "DEFAULT" => "",
                "VARIABLES" => array(),
            ),
            "editor" => array(
                "NAME" => GetMessage("T_IBLOCK_SEF_PAGE_EDITOR"),
                "DEFAULT" => "",
                "VARIABLES" => array("ACTION", "ELEMENT_ID"),
            ),
        ),
    ),
);

?>