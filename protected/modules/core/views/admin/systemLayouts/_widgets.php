<?php
// Register scripts
Yii::app()->clientScript->registerScriptFile(
    $this->module->assetsUrl.'/admin/layouts.widgets.js',
    CClientScript::POS_END
);

$newWidget = new SystemLayoutsWidgets();
?>

<style type="text/css">
    table.widgetsEditTable td,th {
        padding: 3px;
    }
    table.widgetsEditTable th{
        font-weight: bold;
    }
    table.widgetsEditTable input[type="text"] {
        width: 200px;
    }
    table.widgetsEditTable tr.copyMe {
        display: none;
    }
    table.widgetsEditTable {
    }
    table.widgetsEditTable td.desc-column{
        width: 35%;
    }
</style>

<div class="row">
    <button class="btn j-widget-add"><?=Yii::t('main','Добавить')?></button>
</div>

<table class="widgetsEditTable">
    <thead>
    <tr>
        <th></th>
        <th>
            <?php echo CHtml::encode($newWidget->getAttributeLabel('widget_id')) ?>
        </th>
        <th>
            <?php echo CHtml::encode($newWidget->getAttributeLabel('position')) ?>
        </th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php
    $this->renderPartial("widgets/_widget",array(
        'model' => $newWidget,
        'layout' => $model,
        'class' => 'copyMe',
    ));

    if($widgets)
    {
        foreach($widgets as $widget)
        {
            $this->renderPartial("widgets/_widget",array(
                'model' => $widget,
                'layout' => $model,
                'class' => '',
            ));
        }
    }
    ?>
    </tbody>
</table>