<?php

class Commons extends CApplicationComponent {

     

    public function sendHTMLemail($to, $subject, $view, $data) {
        
    }

    public function getEmailConfiguration() {
        
    }

    public function sendPlainEmail($to, $subject, $body) {
        
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Username = "hammadhere7@gmail.com";
        $mail->Password = "665544069";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->SetFrom('hammadhere7@gmail.com', 'Resume Market');
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if($mail->Send())
            return true;
    }
    
    public function getFacebookApp()
    {
        return array(
            'app_id'=>'385788631601930',
            'app_secret'=>'6802185a37d1628b839e8285da718496'
        );
    }
    public function getLinkedInApp() {
        return array(
            'client_id' => '75zao6qnyzpblb',
            'secret_key' => 'U9tuWkmhBg6DeWMt',
            'redirect_url' => Yii::app()->request->getBaseUrl(true).'/login/linkedin',
            'details_url'=>'https://api.linkedin.com/v1/people/~:(first-name,last-name,headline,industry,location,summary,positions,picture-url,email-address)?oauth2_access_token='
            );
    }
    
    public function getGoogleApp() {
        return array(
            'client_id' => '395166122037-spsoqmnbkovra9ul5v4mfk7k7crdfpa8.apps.googleusercontent.com',
            'callback_url' => Yii::app()->request->getBaseUrl(true).'/login/google',
            'client_secret' => '_41XLfurGqA6JGWyVPkwaIel'
        );
    }

}
