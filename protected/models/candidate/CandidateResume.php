<?php

/**
 * This is the model class for table "candidate_resume".
 *
 * The followings are the available columns in table 'candidate_resume':
 * @property integer $id
 * @property integer $candidate_id
 * @property string $filename
 * @property string $directory_name
 * @property string $date_uploaded
 *
 * The followings are the available model relations:
 * @property Candidate $candidate
 * @property JobApplication[] $jobApplications
 */
class CandidateResume extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'candidate_resume';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('candidate_id, filename, directory_name, date_uploaded', 'required'),
			array('candidate_id', 'numerical', 'integerOnly'=>true),
			array('filename, directory_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, candidate_id, filename, directory_name, date_uploaded', 'safe', 'on'=>'search'),
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
			'candidate' => array(self::BELONGS_TO, 'Candidate', 'candidate_id'),
			'jobApplications' => array(self::HAS_MANY, 'JobApplication', 'resume_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'candidate_id' => 'Candidate',
			'filename' => 'Filename',
			'directory_name' => 'Directory Name',
			'date_uploaded' => 'Date Uploaded',
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
		$criteria->compare('candidate_id',$this->candidate_id);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('directory_name',$this->directory_name,true);
		$criteria->compare('date_uploaded',$this->date_uploaded,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CandidateResume the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
