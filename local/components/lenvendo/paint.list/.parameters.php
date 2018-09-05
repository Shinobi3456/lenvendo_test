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
        "SORT" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("SORT"),
            "TYPE" => "INT",
            "DEFAULT" => '',
            "REFRESH" => "Y",
        ],
        "SEF_PAGE_LIST" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("SEF_PAGE_LIST"),
            "TYPE" => "STRING",
            "DEFAULT" => "paint/",
        ],
    ),

);

?>