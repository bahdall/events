<?php

/**
 * This is the model class for table "SystemLayouts".
 *
 * The followings are the available columns in table 'SystemLayouts':
 * @property integer $id
 * @property string $name
 * @property integer $enabled Allow access by url.
 */
class SystemLayouts extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SystemLayouts the static model class
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
		return 'SystemLayouts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, route', 'required'),
			array('route', 'length', 'max'=>100),
			// The following rule is used by search()
			array('name, route', 'safe', 'on'=>'search'),
		);
	}


	public function scopes()
	{
		return array(
			'orderById' => array('order' => 'id DESC'),
		);
	}


	public function relations()
	{
		return array(
			'layout_widgets'=>array(self::HAS_MANY,'SystemLayoutsWidgets','layout_id', 'order' => 'layout_widgets.sort DESC'),
			'widgets'=>array(self::HAS_MANY,'SystemWidgets',array('widget_id'=>'id'),'through'=>'layout_widgets'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('CoreModule.core', 'Название'),
			'route' => Yii::t('CoreModule.core', 'Route'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('route',$this->route);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}