<?php

Yii::import('application.modules.events.models.EventImage');
Yii::import('application.modules.events.models.components.EventImageSaver');

/**
 * This is the model class for table "Events".
 *
 * The followings are the available columns in table 'Events':
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 * @property string $url
 * @property string $short_description
 * @property string $full_description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $created
 * @property string $updated
 * @property string $event_date
 * @property string $status
 * @property string $layout
 * @property string $view
 * @property EventTranslate $translate
 *
 * TODO: Set DB indexes
 */
class Event extends BaseModel
{


	/**
	 * Returns the static model of the specified AR class.
	 * @return Event the static model class
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
		return 'Event';
	}

	public function defaultScope()
	{
		return array(
			'order'=>'event_date DESC',
		);
	}

	public function scopes()
	{
		return array(
			'published'=>array(
				'condition'=>'event_date <= :date AND status = :status',
				'params'=>array(
					':date'=>date('Y-m-d H:i:s')
				),
			),
		);
	}

	/**
	 * Find page by url.
	 * Scope.
	 * @param string Event url
	 * @return Event
	 */
	public function withUrl($url)
	{
		$this->getDbCriteria()->mergeWith(array(
			'condition'=>'url=:url',
			'params'=>array(':url'=>$url)
		));

		return $this;
	}



	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('short_description, full_description', 'type', 'type'=>'string'),
			array('title, event_date', 'required'),
			array('url', 'LocalUrlValidator'),
			array('event_date', 'date', 'format'=>'yyyy-MM-dd HH:mm:ss'),
			array('title, url, meta_title, meta_description, meta_keywords, event_date', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, title, url, short_description, full_description, meta_title, meta_description, meta_keywords, event_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'images' => array(self::HAS_MANY, 'EventImage', 'event_id'),
			'video' => array(self::HAS_MANY, 'EventVideo', 'event_id'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => Yii::t('EventsModule.core', 'Заглавление'),
			'url' => Yii::t('EventsModule.core', 'URL'),
			'short_description' => Yii::t('EventsModule.core', 'Краткое описание'),
			'full_description' => Yii::t('EventsModule.core', 'Содержание'),
			'meta_title' => Yii::t('EventsModule.core', 'Meta Title'),
			'meta_description' => Yii::t('EventsModule.core', 'Meta Description'),
			'meta_keywords' => Yii::t('EventsModule.core', 'Meta Keywords'),
			'event_date' => Yii::t('EventsModule.core', 'Дата События'),
		);
	}

	/**
	 * @return array
	 */
	public static function statuses()
	{
		return array(
			'published'=>Yii::t('EventsModule.core', 'Опубликован'),
			'waiting'=>Yii::t('EventsModule.core', 'Ждет одобрения'),
			'draft'=>Yii::t('EventsModule.core', 'Черновик'),
			'archive'=>Yii::t('EventsModule.core', 'Архив'),
		);
	}

	/**
	 * @return mixed
	 */
	public function getStatusLabel()
	{
		$statuses = $this->statuses();
		return $statuses[$this->status];
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions. Used in admin search.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.url',$this->url,true);
		$criteria->compare('t.short_description',$this->short_description,true);
		$criteria->compare('t.full_description',$this->full_description,true);
		$criteria->compare('t.meta_title',$this->meta_title,true);
		$criteria->compare('t.meta_description',$this->meta_description,true);
		$criteria->compare('t.meta_keywords',$this->meta_keywords,true);
		$criteria->compare('t.event_date',$this->event_date,true);

		// Create sorting by translation title
		$sort=new CSort;
		$sort->attributes=array(
			'*',
			'title' => array(
				'asc'   => 't.title',
				'desc'  => 't.title DESC',
			)
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination'=>array(
				'pageSize'=>20,
			)
		));
	}

	/**
	 * @return bool
	 */
	public function beforeSave()
	{
		if (empty($this->url))
		{
			// Create slug
			Yii::import('ext.SlugHelper.SlugHelper');
			$this->url = SlugHelper::run($this->title);
		}

		// Check if url available
		if($this->isNewRecord)
		{
			$test = Event::model()
				->withUrl($this->url)
				->count();
		}
		else
		{
			$test = Event::model()
				->withUrl($this->url)
				->count('id!=:id', array(':id'=>$this->id));
		}

		if ($test > 0)
			$this->url .= '-'.date('YmdHis');

		return parent::beforeSave();
	}

	/**
	 * Get url to view object on front
	 * @return string
	 */
	public function getViewUrl()
	{
		return Yii::app()->createUrl('events/events/view', array('url'=>$this->url));
	}


	public function addImage(CUploadedFile $image)
	{
		new EventImageSaver($this, $image);
	}

}
