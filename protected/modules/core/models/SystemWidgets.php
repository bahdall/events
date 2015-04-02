<?php

/**
 * This is the model class for table "SystemWidgets".
 *
 * The followings are the available columns in table 'SystemWidgets':
 * @property integer $id
 * @property string $name
 * @property integer $enabled Allow access by url.
 */
class SystemWidgets extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SystemWidgets the static model class
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
		return 'SystemWidgets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, class, module_id', 'required'),
			array('name, class, group', 'length', 'max'=>100),
			array('description, params', 'length', 'max'=>255),
			array('status', 'numerical'),
			// The following rule is used by search()
			array('id, module_id, name, class, description, status, params', 'safe', 'on'=>'search'),
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
			'class' => Yii::t('CoreModule.core', 'Класс виджета'),
			'description' => Yii::t('CoreModule.core', 'Описание'),
			'status' => Yii::t('CoreModule.core', 'Статус'),
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
		$criteria->compare('module_id',$this->module_id);
		$criteria->compare('class',$this->class);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getParams()
	{
		return unserialize($this->params);
	}

	public function setParams($val)
	{
		return $this->params = serialize($val);
	}


	public static function statuses()
	{
		return array(
			0 => Yii::t('main','Отключен'),
			1 => Yii::t('main','Активен'),
		);
	}

}