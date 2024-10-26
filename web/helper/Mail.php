<?php

class Mail
{
    const TABLE = 'config';

    private $model;

    public function __construct()
    {
        $this->model = new Model;
    }

    public function getConfig()
    {
        $query = [
            'table' => self::TABLE,
            'where' => 'ID=1'
        ];
        return $this->model->where($query);
    }

    public function sendSMTP($data = [], $isHTML = false, $debug = 0)
    {
        Load::library('PHPMailer/PHPMailerAutoload');
        $config = $this->getConfig();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = $debug;
        $mail->SMTPAuth = true;
        $mail->Host = $config['SMTPHost'];
        $mail->Username = $config['SMTPEmail'];
        $mail->Password = $config['SMTPPassword'];
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port = $config['SMTPPort'];
        $mail->CharSet = SMTP_CHARSET;
        //
        $mail->From = $data['from_email'];
        $mail->FromName = $data['from_name'];
        $mail->Subject = $data['subject'];

        if ($isHTML) {
            $mail->MsgHTML($data['body']);
            $mail->IsHTML(true);
        } else {
            $mail->Body = $data['body'];
            $mail->AltBody = 'Su servidor de correo no soporta HTML';
        }
        //
        $to_name = isset($data['to_name']) ? $data['to_name'] : '';
        $mail->AddAddress($data['to_email'], $to_name);

        if (isset($data['addcc_emails'])) {
            foreach ($data['addcc_emails'] as $email => $name) {
                $mail->AddCC($email, $name);
            }
        }

        if (isset($data['addbcc_emails'])) {
            foreach ($data['addbcc_emails'] as $email => $name) {
                $mail->addBCC($email, $name);
            }
        }

        if (isset($data['url_attached'])) {
            $filename = isset($data['filename']) ? $data['filename'] : 'Documento PDF';
            $mail->AddAttachment($data['url_attached'], $filename);
        }

        if (!$mail->Send()) {
            $response = [
                'message' => "Error de envío: " . $mail->ErrorInfo,
                'status' => 0
            ];
        } else {
            $response = [
                'message' => "Mensaje envíado correctamente!",
                'status' => 1
            ];
        }

        return $response;
    }

    public function sendPostfix($data = [], $isHTML = false, $debug = 0)
    {
        Load::library('PHPMailer/PHPMailerAutoload');
        $config = $this->getConfig();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = $debug;
        $mail->Host = $config['SMTPHost'];
        $mail->SMTPAuth = false;
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = '';
        $mail->Port = !empty($config['SMTPPort']) ? $config['SMTPPort'] : 25;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        $mail->From = $data['from_email'];
        $mail->FromName = $data['from_name'];
        $mail->Subject = $data['subject'];
        $mail->CharSet = "utf-8";

        if ($isHTML) {
            $mail->MsgHTML($data['body']);
            $mail->IsHTML(true);
        } else {
            $mail->Body = $data['body'];
            $mail->AltBody = 'Su servidor de correo no soporta HTML';
        }
        //
        $to_name = isset($data['to_name']) ? $data['to_name'] : '';
        $mail->AddAddress($data['to_email'], $to_name);

        if (isset($data['addcc_emails'])) {
            foreach ($data['addcc_emails'] as $email => $name) {
                $mail->AddCC($email, $name);
            }
        }

        if (isset($data['addbcc_emails'])) {
            foreach ($data['addbcc_emails'] as $email => $name) {
                $mail->addBCC($email, $name);
            }
        }

        if (isset($data['url_attached'])) {
            $filename = isset($data['filename']) ? $data['filename'] : 'Documento PDF';
            $mail->AddAttachment($data['url_attached'], $filename);
        }

        if (!$mail->Send()) {
            $response = [
                'message' => "Error de envío: " . $mail->ErrorInfo,
                'status' => 0
            ];
        } else {
            $response = [
                'message' => "Mensaje envíado correctamente!",
                'status' => 1
            ];
        }

        if ($debug > 0) {
            Helper::dump($response);
        }

        return $response;
    }
}
