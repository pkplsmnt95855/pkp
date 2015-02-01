<?php

class JobPostForm extends CFormModel {

    public $title;
    public $degree_title;
    public $career_level;
    public $minimum_salary;
    public $maximum_salary;
    public $minimum_experience;
    public $required_travel;
    public $age;
    public $gender;
    public $department;
    public $industry;
    public $number_of_positions;
    public $job_type;
    public $job_description;
    public $locations;
    public $expiry_date;

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, degree_title, career_level, required_travel, age, gender, department, industry, number_of_positions, job_type, job_description,expiry_date', 'required'),
            array('minimum_salary, maximum_salary, minimum_experience, age, number_of_positions', 'numerical', 'integerOnly' => true),
            array('title, degree_title, career_level, department, industry', 'length', 'max' => 255),
            array('locations', 'jobLocation'),
            array('expiry_date', 'pastdate'),
            array('required_travel', 'length', 'max' => 12),
            array('gender', 'length', 'max' => 6),
            array('job_type', 'length', 'max' => 11),
        );
    }

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
            'expiry_date' => 'Last Date to Apply',
            'social' => 'Social',
            'employer_id' => 'Employer',
        );
    }

    public function officialEmail()
    {
        $entered_service = explode('@', $this->email);
        $emailServices = Yii::app()->commons->getEmailServices();

        if (in_array($entered_service[1], $emailServices))
        {
            $this->addError('email', 'Please register using your company\'s domail email address');
        }
    }

    public function existingCompany()
    {
        $employer = Employer::model()->findByAttributes(array('company_name' => $this->company_name));
        if (!empty($employer))
            $this->addError('company_name', 'This company is already registered with the email ' . $employer->email);
    }

    public function dimensionValidation($attribute, $param)
    {
        if (is_object($this->logo))
        {
            list($width, $height) = getimagesize($this->logo->tempname);
            if ($width != 192 || $height != 39)
                $this->addError('logo', 'Logo size should be 192x39 pixels');
        }
    }

    public function jobLocation()
    {
        if (empty($_POST['location']))
            $this->addError('locations', 'Please select at least one location for the job');
    }

    public function pastdate()
    {
        $current_date = strtotime(date('Y-m-d'));
        $job_date = strtotime($this->expiry_date);
        if ($job_date < $current_date)
            $this->addError('expiry_date', 'Last date to apply cannot be in the past');
    }

}
