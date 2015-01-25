<?php

class ResetPasswordForm extends CFormModel {

    public $password;
    public $confirmPassword;

    public function rules()
    {
        return array(
            array('password, confirmPassword', 'required'),
            array('confirmPassword', 'compare', 'compareAttribute' => 'password'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        );
    }

}
