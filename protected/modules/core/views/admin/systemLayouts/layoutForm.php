<?php

/**
 * Create/update layout form
 */

return array(
	'id'=>'languageUpdateForm',
    'showErrorSummary'=>true,
	'elements'=>array(
		'content' => array(
            'type' => 'form',
            'title'=>Yii::t('CoreModule.core', 'Содержимое'),
            'elements' => array(
                'name'=>array(
                    'type'=>'text',
                ),
                'route'=>array(
                    'type'=>'text',
                    'hint'=>Yii::t('CoreModule.core', 'Например: store/Category/%'),
                ),
            ),
        ),
	),
);

