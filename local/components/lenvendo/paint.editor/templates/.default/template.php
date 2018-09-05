<?
use Bitrix\Main\Application;

CJSCore::Init(array("jquery"));
$this->addExternalJS("/local/components/lenvendo/paint.editor/templates/.default//jquery.jqscribble.js");
?>
<script type="text/javascript">
    var src = "<?=(isset($arResult['ID']) && $arResult['ID'] > 0?CFile::GetPath($arResult['DETAIL_PICTURE']) : "")?>";
</script>
<? if(isset($arResult['ID']) && $arResult['ID'] > 0){?>
    <input id="elementid" type="hidden" name="ELEMENT_ID" value="<?=$arResult['ID']?>"/>
<?}?>

<p>
    <label for="passw">Пароль:</label>
    <input id="passw" type="password" name="passw" value=""/>
    <button id="saveimg" class="button">Сохранить</button>
</p>
<p>
<button id="clear" class="button">Очистить</button>
</p>
<div class="palet_wrapper">
    <canvas id="paintCanvas" width = "800" height = "800"></canvas>
</div>

<div class="clear"></div>


