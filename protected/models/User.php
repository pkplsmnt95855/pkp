<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $facebook_id
 * @property string $linkedin_id
 * @property string $google_id
 * @property string $status
 * @property string $activation_key
 * @property string $reset_key
 * @property string $role
 */
class User extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password, status, role', 'required'),
            array('email, password, facebook_id, linkedin_id, google_id, activation_key, reset_key', 'length', 'max' => 255),
            array('status', 'length', 'max' => 8),
            array('role', 'length', 'max' => 6),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, password, facebook_id, linkedin_id, google_id, status, activation_key, reset_key, role', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'facebook_id' => 'Facebook',
            'linkedin_id' => 'Linkedin',
            'google_id' => 'Google',
            'status' => 'Status',
            'activation_key' => 'Activation Key',
            'reset_key' => 'Reset Key',
            'role' => 'Role',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('facebook_id', $this->facebook_id, true);
        $criteria->compare('linkedin_id', $this->linkedin_id, true);
        $criteria->compare('google_id', $this->google_id, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('activation_key', $this->activation_key, true);
        $criteria->compare('reset_key', $this->reset_key, true);
        $criteria->compare('role', $this->role, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
