<?php
// Register scripts
Yii::app()->clientScript->registerScriptFile(
    $this->module->assetsUrl.'/admin/banners.admin.js',
    CClientScript::POS_END
);

$newImage = new BannersImages();

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
            <?php echo CHtml::encode($newImage->getAttributeLabel('title')) ?>
        </th>
        <th></th>
        <th>
            <?php echo CHtml::encode($newImage->getAttributeLabel('description')) ?>
        </th>
        <th></th>
        <th>
            <?php echo CHtml::encode($newImage->getAttributeLabel('link')) ?>
        </th>
        <th></th>
        <th>
            <?php echo CHtml::encode($newImage->getAttributeLabel('image')) ?>
        </th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php
    $this->renderPartial("images/_image",array(
        'model' => $newImage,
        'banner' => $model,
        'class' => 'copyMe',
    ));

    if($images)
    {
        foreach($images as $image)
        {
            $this->renderPartial("images/_image",array(
                'model' => $image,
                'banner' => $model,
                'class' => '',
            ));
        }
    }

    $this->renderPartial("images/_image",array(
        'model' => $newImage,
        'banner' => $model,
        'class' => '',
    ));
    ?>
    </tbody>
</table>