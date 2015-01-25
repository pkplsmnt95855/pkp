<?php

class ForgotPasswordForm extends CFormModel {

    public $email;

    public function rules()
    {
        return array(
            array('email', 'required'),
            array('email', 'validUser'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
        );
    }

    public function validUser()
    {
        $user = User::model()->findByAttributes(array('email' => $this->email));
        if (empty($user))
            $this->addError('email', 'This email does not belong to any user.');
    }

}
