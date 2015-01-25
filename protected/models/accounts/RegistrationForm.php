<?php

class RegistrationForm extends CFormModel {

    public $email;
    public $password;
    public $confirmPassword;

    public function rules()
    {
        return array(
            array('email, password, confirmPassword', 'required'),
            array('email', 'email'),
            array('confirmPassword', 'compare', 'compareAttribute' => 'password'),
            array('email', 'unique', 'className' => 'User')
        );
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        );
    }

}
