<?php

class ResumeUploadForm extends CFormModel {

    public $cv;

    public function rules()
    {
        return array(
            array('cv', 'file',
                'types' => 'pdf, doc,docx,rtf',
                'maxSize' => 1024 * 1024 * 2,
                'allowEmpty' => true),
            array('cv', 'maxCount')
        );
    }

    public function attributeLabels()
    {
        return array(
            'cv' => 'Resume',
        );
    }

    public function maxCount()
    {
        $user_resumes = CandidateResume::model()->findAllByAttributes(array('candidate_id' => Yii::app()->user->id));
        if (count($user_resumes) >= 5)
            $this->addError('cv', 'You cannot upload more than five resumes');
    }

}
