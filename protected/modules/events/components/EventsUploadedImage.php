<?php

Yii::import('application.modules.events.components.EventsImagesConfig');

/**
 * Validate uploaded product image.
 * Create unique image name.
 */
class EventsUploadedImage
{

	/**
	 * @param CUploadedFile $image
	 * @return bool
	 */
	public static function isAllowedSize(CUploadedFile $image)
	{
		return ($image->getSize() <= EventsImagesConfig::get('maxFileSize'));
	}

	/**
	 * @param CUploadedFile $image
	 * @return bool
	 */
	public static function isAllowedExt(CUploadedFile $image)
	{
		return in_array(strtolower($image->getExtensionName()),  EventsImagesConfig::get('extensions'));
	}

	/**
	 * @param CUploadedFile $image
	 * @return bool
	 */
	public static function isAllowedType(CUploadedFile $image)
	{
		$type = CFileHelper::getMimeType($image->getTempName());
		if(!$type)
			$type = CFileHelper::getMimeTypeByExtension($image->getName());
		return in_array($type,  EventsImagesConfig::get('types'));
	}

	/**
	 * @param CUploadedFile $image
	 * @return bool
	 */
	public static function hasErrors(CUploadedFile $image)
	{
		return !(!$image->getError() && self::isAllowedExt($image) === true && self::isAllowedSize($image) === true && self::isAllowedType($image) === true);
	}

	/**
	 * @return string Path to save product image
	 */
	public static function getSavePath()
	{
		return Yii::getPathOfAlias(EventsImagesConfig::get('path'));
	}

	/**
	 * @param Event $model
	 * @param CUploadedFile $image
	 * @return string
	 */
	public static function createName(Event $model, CUploadedFile $image)
	{
		$path = self::getSavePath();
		$name = self::generateRandomName($model, $image);

		if (!file_exists($path.'/'.$name))
			return $name;
		else
			self::createName($model, $image);
	}

	/**
	 * Generates random name bases on product and image models
	 *
	 * @param Event $model
	 * @param CUploadedFile $image
	 * @return string
	 */
	public static function generateRandomName(Event $model, CUploadedFile $image)
	{
		return strtolower($model->id.'_'.crc32(microtime()).'.'.$image->getExtensionName());
	}

}