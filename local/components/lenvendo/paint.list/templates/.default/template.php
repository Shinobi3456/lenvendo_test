<div class="col-md-12">
	<a href="<?=$arResult['LIST_URL']?>editor/create/" class="add">Создать новый рисунок</a>
	<ul class="list">
		<?php foreach ($arResult['ELEMENTS'] as $element):?>
			<li>
					<a href="<?=$arResult['LIST_URL']?>editor/<?=$element['ID']?>/">
						<img src="<?=$element['DETAIL_PICTURE_SRC']?>" alt="<?=$element['NAME']?>" class="image-responsive">
						<p>Индетификатор: <?=$element['NAME']?></p>
					</a>
			</li>
		<?php endforeach;?>
	</ul>
</div>
