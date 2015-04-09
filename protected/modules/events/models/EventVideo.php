<?php

Yii::import('application.modules.events.components.EventsImagesConfig');
Yii::import('ext.phpthumb.PhpThumbFactory');
Yii::import('application.modules.events.components.EventsUploadedImage');

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
class EventVideo extends BaseModel
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
        return 'EventVideo';
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
            'image'          => Yii::t('EventsModule.admin', 'Изображение'),
            'video'          => Yii::t('EventsModule.admin', 'Видео'),
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


    public function addImage(CUploadedFile $image)
    {
        $name     = rand(1,1000).time().rand(1,100).".".$image->getExtensionName();
        $fullPath = EventsUploadedImage::getSavePath().'/'.$name;
        $image->saveAs($fullPath);
        @chmod($fullPath, 0666);

        $this->image = $name;

        $this->resize($fullPath);
    }

    public function resize($fullPath)
    {
        $thumb  = PhpThumbFactory::create($fullPath);
        $sizes  = EventsImagesConfig::get('maximum_image_size');
        $method = EventsImagesConfig::get('resizeMethod');
        $thumb->$method($sizes[0], $sizes[0])->save($fullPath);
    }

}