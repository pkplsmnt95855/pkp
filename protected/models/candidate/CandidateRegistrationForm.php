<?php

class CandidateRegistrationForm extends CFormModel {

    public $email;
    public $password;
    public $confirmPassword;
    public $firstname;
    public $lastname;
    public $verifyCode;

    public function rules()
    {
        return array(
            array('email,password,confirmPassword,firstname,lastname', 'required'),
            array('confirmPassword', 'compare', 'compareAttribute' => 'password'),
            array('email', 'email'),
            array('email', 'unique', 'className' => 'Candidate',
                'attributeName' => 'email',
                'message' => 'This email is already registered'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'verifyCode' => 'Captcha Code',
        );
    }


}
