<?
$id = $model->id;
if(!$model->id)$id = substr(str_replace(' ','',microtime()),rand(2,5));
?>

<tr class="<?=$class?>" data-id = "<?=$id?>">
    <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></td>
    <td>
        <?php echo CHtml::textField('images['.$id.'][title]',$model->title,array('class' => 'j-title')) ?>
    </td>
    <td></td>
    <td class="desc-column">
        <?php echo CHtml::textArea('images['.$id.'][description]',$model->description,array(
            'class' => 'j-description',
            'rows'   => '75',
            'cols'   => '45',
            'style'  => 'width: 85%;',
        )); ?>
    </td>
    <td></td>
    <td>
        <?php echo CHtml::textField('images['.$id.'][link]',$model->link,array('class' => 'j-link')) ?>
    </td>
    <td></td>
    <td>
        <?php// echo CHtml::textField('images['.$id.'][image]',$model->image,array('class' => 'j-image')) ?>
        <?php
        //server file input
        $this->widget('ext.elFinder.ServerFileInput', array(
                'attribute' => 'image',
                'connectorRoute' => 'filemanager/elfinderconnector',
                'htmlOptions' => array(
                    'id' => $id,
                    'class' => 'j-elfinder',
                    'name' => 'images['.$id.'][image]',
                ),
                'value' => $model->image,
                'settings' => array(
                    'open' => 'alert("dsadasdsadas")',
                ),
            )
        );

        ?>
    </td>
    <td>
        <a href="#" class="deleteRow"><?php echo Yii::t('BannersModule.admin', 'Удалить') ?></a>
    </td>
</tr>