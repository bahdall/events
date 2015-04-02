<?php

/**
 * This is the model class for table "SystemLayoutsWidgets".
 *
 * The followings are the available columns in table 'SystemLayoutsWidgets':
 * @property integer $id
 * @property string $name
 * @property integer $enabled Allow access by url.
 */
class SystemLayoutsWidgets extends BaseModel
{

	public $positions = array(
		'Left' => 'Left',
		'Right' => 'Right',
		'Top' => 'Top',
		'Bottom' => 'Bottom',
	);

	/**
	 * Returns the static model of the specified AR class.
	 * @return SystemLayoutsWidgets the static model class
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
		return 'SystemLayoutsWidgets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('widget_id, layout_id, position', 'required'),
			array('position', 'length', 'max'=>50),
			array('sort', 'numerical'),
			// The following rule is used by search()
			array('widget_id, layout_id, position, sort', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		return array(
			'widget'=>array(self::HAS_ONE,'SystemWidgets',array('id'=>'widget_id')),
			'layout'=>array(self::HAS_ONE,'SystemLayouts',array('id'=>'layout_id')),
		);
	}


	public function scopes(){
		return array(
			'sort' => array('order' => 'sort DESC'),
		);
	}



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'widget_id' => Yii::t('CoreModule.core', 'Виджет'),
			'layout_id' => Yii::t('CoreModule.core', 'Слой'),
			'position' => Yii::t('CoreModule.core', 'Позиция'),
			'sort' => Yii::t('CoreModule.core', 'Порядок сортировки'),
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
		$criteria->compare('widget_id',$this->widget_id);
		$criteria->compare('layout_id',$this->layout_id);
		$criteria->compare('position',$this->position);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function listPositions()
	{
		return $this->positions;
	}

}