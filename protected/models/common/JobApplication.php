<?php

/**
 * This is the model class for table "job_application".
 *
 * The followings are the available columns in table 'job_application':
 * @property integer $id
 * @property integer $job_id
 * @property integer $candidate_id
 * @property string $date_applied
 * @property string $status
 * @property string $cover_letter
 * @property integer $resume_id
 *
 * The followings are the available model relations:
 * @property CandidateResume $resume
 * @property Job $job
 * @property Candidate $candidate
 */
class JobApplication extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'job_application';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_id, cover_letter, resume_id', 'required'),
			array('job_id, candidate_id, resume_id', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, job_id, candidate_id, date_applied, status, cover_letter, resume_id', 'safe', 'on'=>'search'),
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
			'resume' => array(self::BELONGS_TO, 'CandidateResume', 'resume_id'),
			'job' => array(self::BELONGS_TO, 'Job', 'job_id'),
			'candidate' => array(self::BELONGS_TO, 'Candidate', 'candidate_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'job_id' => 'Job',
			'candidate_id' => 'Candidate',
			'date_applied' => 'Date Applied',
			'status' => 'Status',
			'cover_letter' => 'Cover Letter',
			'resume_id' => 'Resume',
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
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('candidate_id',$this->candidate_id);
		$criteria->compare('date_applied',$this->date_applied,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('cover_letter',$this->cover_letter,true);
		$criteria->compare('resume_id',$this->resume_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JobApplication the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
