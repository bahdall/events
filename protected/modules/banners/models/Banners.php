<?php
Yii::import('application.modules.banners.models.BannersImages');

/**
 * This is the model class for table "Banners".
 *
 * The followings are the available columns in table 'Banners':
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * TODO: Set DB indexes
 */
class Banners extends BaseModel
{


	/**
	 * Returns the static model of the specified AR class.
	 * @return Banner the static model class
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
		return 'Banners';
	}



	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, status', 'required'),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			array('id, name, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'images'=>array(self::HAS_MANY, 'BannersImages', 'banner_id', 'order' => 'images.sort DESC', 'with' => 'translate'),
		);
	}


	public function scopes()
	{
		return array(
			'active' => array(
				'condition' => 'status !=0'
			),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('BannersModule.core', 'Название'),
			'status' => Yii::t('BannersModule.core', 'Статус'),
		);
	}

	/**
	 * @return array
	 */
	public static function statuses()
	{
		return array(
			'0'=>Yii::t('BannersModule.core', 'Не активен'),
			'1'=>Yii::t('BannersModule.core', 'Активен'),
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
		$criteria->compare('t.name',$this->name);
		$criteria->compare('t.status',$this->status);

		// Create sorting by translation title
		$sort=new CSort;
		$sort->attributes=array(
			'*',
			'name' => array(
				'asc'   => 't.name',
				'desc'  => 't.name DESC',
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

		return parent::beforeSave();
	}


	public static function getBanners()
	{
		$model = Banners::model()->active()->findAll();

		return CHtml::listData($model,'id','name');
	}


}
