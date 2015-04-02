<?php

Yii::import('ext.phpthumb.PhpThumbFactory');
Yii::import('application.modules.events.components.EventsImagesConfig');
Yii::import('application.modules.events.components.EventsUploadedImage');

/**
 * Class EventImageSaver
 *
 * Save/handle uploaded event images
 */
class EventImageSaver
{
	/**
	 * @param Event $event
	 * @param CUploadedFile $image
	 */
	public function __construct(Event $event, CUploadedFile $image)
	{

		$name     = EventsUploadedImage::createName($event, $image);
		$fullPath = EventsUploadedImage::getSavePath().'/'.$name;
		$image->saveAs($fullPath);
		@chmod($fullPath, 0666);

		// Check if event has main image
		$is_main = (int) EventImage::model()->countByAttributes(array(
			'event_id' => $event->id,
		));

		$imageModel = new EventImage;
		$imageModel->event_id    = $event->id;
		$imageModel->image          = $name;
		$imageModel->save();

		$this->resize($fullPath);
		$this->watermark($fullPath);
	}

	/**
	 * Resize uploaded image if sizes bigger defined in settings table
	 *
	 * @param $fullPath string
	 */
	public function resize($fullPath)
	{
		$thumb  = PhpThumbFactory::create($fullPath);
		$sizes  = EventsImagesConfig::get('maximum_image_size');
		$method = EventsImagesConfig::get('resizeMethod');
		$thumb->$method($sizes[0], $sizes[0])->save($fullPath);
	}

	/**
	 * Draws watermark on image.
	 *
	 * @param $fullPath string to image
	 */
	public function watermark($fullPath)
	{
		// Add watermark;
		if(EventsImagesConfig::get('watermark_active'))
		{
			$pic = PhpThumbFactory::create($fullPath);
			$pos = EventsImagesConfig::get('watermark_position_vertical').EventsImagesConfig::get('watermark_position_horizontal');

			try {
				$watermark = PhpThumbFactory::create(Yii::getPathOfAlias('webroot.uploads') . '/watermark.png');

				$pic->addWatermark(
					$watermark,
					$pos,
					EventsImagesConfig::get('watermark_opacity'),
					0,
					0
				);
				$pic->save($fullPath);
			} catch(Exception $e) {
				// pass
			}
		}
	}
}