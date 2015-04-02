<?php

$this->pageHeader = Yii::t('AdminModule.admin', 'Админ панель GoodOne');

$this->breadcrumbs = array(
	'Home'=>$this->createUrl('/admin'),
	Yii::t('AdminModule.admin', 'Главная'),
);

?>
<div class="blockContent" style="font-size: 16px; padding: 20px">
	Добро Пожаловать!
</div>

