<?php

/**
 * This is the model class for table "candidate".
 *
 * The followings are the available columns in table 'candidate':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $activation_key
 * @property string $reset_key
 * @property string $status
 * @property string $role
 */
class Candidate extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'candidate';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password, firstname, lastname', 'required'),
            array('email, password, firstname, lastname, activation_key, reset_key', 'length', 'max' => 255),
            array('status', 'length', 'max' => 8),
            array('role', 'length', 'max' => 9),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, password, firstname, lastname, activation_key, reset_key, status, role', 'safe', 'on' => 'search'),
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
            'candidateResumes' => array(self::HAS_MANY, 'CandidateResume', 'candidate_id'),
            'jobApplications' => array(self::HAS_MANY, 'JobApplication', 'candidate_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'activation_key' => 'Activation Key',
            'reset_key' => 'Reset Key',
            'status' => 'Status',
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('activation_key', $this->activation_key, true);
        $criteria->compare('reset_key', $this->reset_key, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('role', $this->role, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Candidate the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
