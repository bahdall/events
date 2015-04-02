<?php

class SliderForm extends CFormModel
{

    /**
     * @var string
     */
    public $id;
    public $name;
    public $banner_id;
    public $width;
    public $height;
    public $status;
    public $module_id;
    public $group = 'sliders';
    public $class = 'application.modules.banners.widgets.nivoslider.ENivoSlider';



    public function init()
    {

    }

    public function getData($id)
    {
        if($id)
        {
            $this->id = $id;
            $slider = SystemWidgets::model()->findByPk($this->id);
            if($slider)
            {
                $this->name = $slider->name;
                $this->status = $slider->status;
                $params = $slider->getParams();
                $this->width = $params['width'];
                $this->height = $params['height'];
                $this->banner_id = $params['banner_id'];
            }
        }
    }
    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('name, banner_id, width, height, status', 'required'),
            array('status, banner_id, width, height', 'numerical'),
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'name' => Yii::t('BannersModule.core','Название'),
            'banner_id' => Yii::t('BannersModule.core','Баннер'),
            'width' => Yii::t('BannersModule.core','Ширина'),
            'height' => Yii::t('BannersModule.core','Высота'),
            'status' => Yii::t('BannersModule.core','Статус'),
        );
    }

    /**
     * Saves attributes into database
     */
    public function save()
    {
        $widget = SystemWidgets::model()->findByPk($this->id);
        if(!$widget)$widget = new SystemWidgets();

        $widget->attributes = $this->attributes;
        $widget->setParams(array(
            'width' => $this->width,
            'height' => $this->height,
            'banner_id' => $this->banner_id,
        ));
        $widget->save();
    }

}
