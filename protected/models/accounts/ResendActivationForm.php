<?php

class ResendActivationForm extends CFormModel {

    public $email;

    public function rules()
    {
        return array(
            array('email', 'required'),
            array('email', 'validUser'),
            array('email', 'activeUser')
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

    public function activeUser()
    {
        $user = User::model()->findByAttributes(array('email' => $this->email));
        if (!empty($user))
        {
            if ($user->status == 'Active')
                $this->addError('email', 'Your account is already active. Please login with your credentials');
        }
    }

}
