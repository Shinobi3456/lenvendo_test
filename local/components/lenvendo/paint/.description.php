<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("IBLOCK_ELEMENT_ADD_DESCRIPTION"),
	"COMPLEX" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "paint",
			"NAME" => GetMessage("T_IBLOCK_DESC_ELEMENT_ADD"),
			"CHILD" => array(
				"ID" => "element_add_cmpx",
			),
		),
	),
);
?>