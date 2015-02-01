<?php

class EmployerRegistrationForm extends CFormModel {

    public $email;
    public $password;
    public $confirmPassword;
    public $logo;
    public $company_description;
    public $company_name;
    public $verifyCode;

    public function rules()
    {
        return array(
            array('email,password,confirmPassword,company_name', 'required'),
            array('confirmPassword', 'compare', 'compareAttribute' => 'password'),
            array('email', 'email'),
//            array('email', 'officialEmail'),
            array('email', 'existingCompany'),
            array('email', 'unique', 'className' => 'Employer',
                'attributeName' => 'email',
                'message' => 'This email is already registered'),
            array('logo', 'file',
                'types' => 'jpg, gif, png',
                'maxSize' => 1024 * 1024 * 3,
                'allowEmpty' => true),
            array('logo', 'dimensionValidation'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
            'logo' => 'Company Logo',
            'verifyCode' => 'Captcha Code',
            'company_name' => 'Company Name',
            'company_description' => 'Company Description'
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

}
