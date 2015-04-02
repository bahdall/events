<?
$id = $model->id;
$chosen = true;
if(!$model->id){
    $id = 'copyMe';
    $chosen = false;
}
?>

<tr class="<?=$class?>" data-id = "<?=$id?>">
    <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></td>
    <td>
        <?php echo CHtml::dropDownList('widgets['.$id.'][widget_id]',$model->widget_id,
            CHtml::listData(SystemWidgets::model()->findAll(), 'id', 'name'),
            array(
                'id' => 'widget_id_'.$id,
            )
        );

        if($chosen)
        {
            $this->widget('application.modules.admin.widgets.schosen.SChosen', array(
                'elements'=>array('widget_id_'.$id)
            ));
        }
        ?>
    </td>

    <td>

        <?php echo CHtml::dropDownList('widgets['.$id.'][position]',$model->position,
            $model->listPositions(),
            array(
                'id' => 'position_'.$id,
            )
        );
        echo CHtml::hiddenField('widgets['.$id.'][sort]',$model->sort,array(
            'class' => 'j-sort',
        ));
        ?>
    </td>

    <td>
        <a href="#" class="deleteRow"><?php echo Yii::t('CoreModule.admin', 'Удалить') ?></a>
    </td>
</tr>