<?php

/**
 * This is the model class for table "employer".
 *
 * The followings are the available columns in table 'employer':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $activation_key
 * @property string $reset_key
 * @property string $status
 * @property string $role
 * @property string $company_name
 * @property string $company_description
 * @property string $logo
 *
 * The followings are the available model relations:
 * @property Job[] $jobs
 */
class Employer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password, company_name, logo', 'required'),
			array('email, password, activation_key, reset_key, company_name, logo', 'length', 'max'=>255),
			array('status, role', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, activation_key, reset_key, status, role, company_name, company_description, logo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'jobs' => array(self::HAS_MANY, 'Job', 'employer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'activation_key' => 'Activation Key',
			'reset_key' => 'Reset Key',
			'status' => 'Status',
			'role' => 'Role',
			'company_name' => 'Company Name',
			'company_description' => 'Company Description',
			'logo' => 'Logo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('activation_key',$this->activation_key,true);
		$criteria->compare('reset_key',$this->reset_key,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_description',$this->company_description,true);
		$criteria->compare('logo',$this->logo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
