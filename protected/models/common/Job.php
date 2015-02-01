<?php

/**
 * This is the model class for table "job".
 *
 * The followings are the available columns in table 'job':
 * @property integer $id
 * @property string $title
 * @property string $degree_title
 * @property string $career_level
 * @property integer $minimum_salary
 * @property integer $maximum_salary
 * @property integer $minimum_experience
 * @property string $required_travel
 * @property integer $age
 * @property string $gender
 * @property string $department
 * @property string $industry
 * @property integer $number_of_positions
 * @property string $job_type
 * @property string $job_description
 * @property string $status
 * @property string $posted_date
 * @property string $expiry_date
 * @property string $social
 * @property integer $employer_id
 *
 * The followings are the available model relations:
 * @property Employer $employer
 * @property JobLocation[] $jobLocations
 * @property JobSkill[] $jobSkills
 */
class Job extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'job';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, degree_title, career_level, minimum_salary, required_travel, age, gender, department, industry, number_of_positions, job_type, job_description, status, posted_date, expiry_date, employer_id', 'required'),
            array('minimum_salary, maximum_salary, minimum_experience, age, number_of_positions, employer_id', 'numerical', 'integerOnly' => true),
            array('title, degree_title, career_level, department, industry', 'length', 'max' => 255),
            array('required_travel', 'length', 'max' => 12),
            array('gender', 'length', 'max' => 6),
            array('job_type', 'length', 'max' => 11),
            array('status', 'length', 'max' => 8),
            array('social', 'length', 'max' => 3),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, degree_title, career_level, minimum_salary, maximum_salary, minimum_experience, required_travel, age, gender, department, industry, number_of_positions, job_type, job_description, status, posted_date, expiry_date, social, employer_id', 'safe', 'on' => 'search'),
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
            'employer' => array(self::BELONGS_TO, 'Employer', 'employer_id'),
            'jobApplications' => array(self::HAS_MANY, 'JobApplication', 'job_id'),
            'jobLocations' => array(self::HAS_MANY, 'JobLocation', 'job_id'),
            'jobSkills' => array(self::HAS_MANY, 'JobSkill', 'job_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'degree_title' => 'Degree Title',
            'career_level' => 'Career Level',
            'minimum_salary' => 'Minimum Salary',
            'maximum_salary' => 'Maximum Salary',
            'minimum_experience' => 'Minimum Experience',
            'required_travel' => 'Required Travel',
            'age' => 'Age',
            'gender' => 'Gender',
            'department' => 'Department',
            'industry' => 'Industry',
            'number_of_positions' => 'Number Of Positions',
            'job_type' => 'Job Type',
            'job_description' => 'Job Description',
            'status' => 'Status',
            'posted_date' => 'Posted Date',
            'expiry_date' => 'Expiry Date',
            'social' => 'Social',
            'employer_id' => 'Employer',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('degree_title', $this->degree_title, true);
        $criteria->compare('career_level', $this->career_level, true);
        $criteria->compare('minimum_salary', $this->minimum_salary);
        $criteria->compare('maximum_salary', $this->maximum_salary);
        $criteria->compare('minimum_experience', $this->minimum_experience);
        $criteria->compare('required_travel', $this->required_travel, true);
        $criteria->compare('age', $this->age);
        $criteria->compare('gender', $this->gender, true);
        $criteria->compare('department', $this->department, true);
        $criteria->compare('industry', $this->industry, true);
        $criteria->compare('number_of_positions', $this->number_of_positions);
        $criteria->compare('job_type', $this->job_type, true);
        $criteria->compare('job_description', $this->job_description, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('posted_date', $this->posted_date, true);
        $criteria->compare('expiry_date', $this->expiry_date, true);
        $criteria->compare('social', $this->social, true);
        $criteria->compare('employer_id', $this->employer_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Job the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
