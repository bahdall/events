<?
$id = $model->id;
if(!$model->id)$id = substr(str_replace(' ','',microtime()),rand(2,5));
?>

<tr class="<?=$class?>" data-id = "<?=$id?>">
    <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></td>
    <td class="desc-column">
        <?php echo CHtml::textField('video['.$id.'][video]',$model->video,array(
            'class' => 'j-video',
        )); ?>
    </td>
    <td>
        <?php// echo CHtml::textField('video['.$id.'][image]',$model->image,array('class' => 'j-image')) ?>
        <?php
        if($model->image):
            echo CHtml::image($model->getUrl('100x100')).'<br>';
        endif;
        echo CHtml::fileField('videoImage['.$id.']', $model->image,array(
            'class' => 'j-image'
        ));
        ?>
    </td>
    <td>
        <a href="#" class="deleteRow"><?php echo Yii::t('EventsModule.admin', 'Удалить') ?></a>
    </td>
</tr>