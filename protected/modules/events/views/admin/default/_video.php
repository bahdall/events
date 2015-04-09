<?php
// Register scripts
Yii::app()->clientScript->registerScriptFile(
    $this->module->assetsUrl.'/admin/video.admin.js',
    CClientScript::POS_END
);

$newVideo = new EventVideo();

?>

<style type="text/css">
    table.imagesEditTable td,th {
        padding: 3px;
    }
    table.imagesEditTable th{
        font-weight: bold;
    }
    table.imagesEditTable input[type="text"] {
        width: 200px;
    }
    table.imagesEditTable tr.copyMe {
        display: none;
    }
    table.imagesEditTable {
    }
    table.imagesEditTable td.desc-column{
        width: 35%;
    }
</style>

<div class="row">
    <button class="btn j-image-add"><?=Yii::t('main','Добавить')?></button>
</div>

<table class="imagesEditTable">
    <thead>
    <tr>
        <th></th>
        <th>
            <?php echo CHtml::encode($newVideo->getAttributeLabel('video')) ?>
        </th>
        <th>
            <?php echo CHtml::encode($newVideo->getAttributeLabel('image')) ?>
        </th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php
    $this->renderPartial("video/_video",array(
        'model' => $newVideo,
        'event' => $model,
        'class' => 'copyMe',
    ));

    if($model->video)
    {
        foreach($model->video as $video)
        {
            $this->renderPartial("video/_video",array(
                'model' => $video,
                'event' => $model,
                'class' => '',
            ));
        }
    }

    $this->renderPartial("video/_video",array(
        'model' => $newVideo,
        'event' => $model,
        'class' => '',
    ));
    ?>
    </tbody>
</table>