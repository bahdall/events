<?php

Yii::import('application.modules.events.components.EventsImagesConfig');

/**
 * This is the model class for table "EventsProductImage".
 *
 * The followings are the available columns in table 'EventsProductImage':
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property integer $is_main
 * @property integer $uploaded_by
 * @property string $date_uploaded
 * @property string $title
 */
class EventImage extends BaseModel
{
    /**
     * Returns the static model of the specified AR class.
     * @return EventsProductImage the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'EventImage';
    }


    /**
     * Get url to product image. Enter $size to resize image.
     * @param mixed $size New size of the image. e.g. '150x150'
     * @param mixed $resizeMethod Resize method name to override config. resize/adaptiveResize
     * @param mixed $random Add random number to the end of the string
     * @return string
     */
    public function getUrl($size = false, $resizeMethod = false, $random = false)
    {
        if($size !== false)
        {
            $thumbPath = Yii::getPathOfAlias(EventsImagesConfig::get('thumbPath')).'/'.$size;
            if(!file_exists($thumbPath))
                mkdir($thumbPath, 0777, true);

            // Path to source image
            $fullPath  = Yii::getPathOfAlias(EventsImagesConfig::get('path')).'/'.$this->image;
            // Path to thumb
            $thumbPath = $thumbPath.'/'.$this->image;

            if(!file_exists($thumbPath))
            {
                // Resize if needed
                Yii::import('ext.phpthumb.PhpThumbFactory');
                $sizes  = explode('x', $size);
                $thumb  = PhpThumbFactory::create($fullPath);

                if($resizeMethod === false)
                    $resizeMethod = EventsImagesConfig::get('resizeThumbMethod');
                $thumb->$resizeMethod($sizes[0],$sizes[1])->save($thumbPath);
            }

            return EventsImagesConfig::get('thumbUrl').$size.'/'.$this->image;
        }

        if ($random === true)
            return EventsImagesConfig::get('url').$this->image.'?'.rand(1, 10000);
        return EventsImagesConfig::get('url').$this->image;
    }

    public function attributeLabels()
    {
        return array(
            'event_id'    => Yii::t('EventsModule.admin', 'Событие'),
            'image'          => Yii::t('EventsModule.admin', 'Имя файла'),
        );
    }

    /**
     * Delete file, etc...
     */
    public function afterDelete()
    {
        // Delete file
        if (file_exists($this->filePath))
            unlink($this->filePath);

        return parent::afterDelete();
    }

    /**
     * @return string
     *
     */
    public function getFilePath()
    {
        return Yii::getPathOfAlias(EventsImagesConfig::get('path')).'/'.$this->image;
    }

}