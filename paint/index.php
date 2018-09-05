<?require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');?>

<?
$APPLICATION->IncludeComponent(
    'lenvendo:paint',
    '',
    [
        'IBLOCK_ID'		=> 3,
        'TMP_FOLDER'	=> '/upl/',
        'SEF_MODE'      => 'Y',
        'SEF_FOLDER' => '/paint/',
        'SEF_URL_TEMPLATES' => array(
            'list'       => 'paint/',
            'editor'     => 'paint/#ACTION#/#ELEMENT_ID#/',
        )
    ]
);
?>

<?require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>