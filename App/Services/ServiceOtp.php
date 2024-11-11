<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class ServiceOtp
{
    private $host, $username, $password, $emailAddress, $appName, $replyAddress, $replyname;

    public function __construct()
    {
        $this->host = $_ENV['MAILER_HOST'];
        $this->username = $_ENV['MAILER_USERNAME'];
        $this->password = $_ENV['MAILER_PASSWORD'];
        $this->emailAddress = $_ENV['MAILER_EMAIL_ADDRESS'];
        $this->appName = $_ENV['MAILER_APP_NAME'];
        $this->replyAddress = $_ENV['MAILER_REPLY_ADDRESS'];
        $this->replyname = $_ENV['MAILER_REPLY_NAME'];
    }

    public function sendOtp($toEmail, $otp, $token)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = $this->host;
            $mail->SMTPAuth = true;
            $mail->Username = $this->username;
            $mail->Password = $this->password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom($this->emailAddress, $this->appName);
            $mail->addAddress($toEmail);
            $mail->addReplyTo($this->replyAddress, $this->replyname);

            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP untuk Reset Password';
            $mail->Body = '<body style="margin: 0; padding: 2rem; background-color: #F5F9FC; font-family: Arial, sans-serif;">
    <table align="center" width="100%" style="max-width: 600px; background-color: #FFFFFF; padding: 20px;">

        <!-- Header -->
        <tr>
            <td>
                <table style="margin: 0 auto;">
                    <tr>
                        <td>
                            <img src="Logo-PelatihanKu-Apps.png" alt="Logo-PelatihanKu-Apps" width="20" style=" margin: 0 auto; display: block; margin-right: 5px;">
                        </td>
                        <td>
                            <h2 style="font-size: 1.2rem; color: #333333;">Balai Latihan Kerja</h2>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <hr style="border: none; border-top: 1px solid #aaa8a856; margin: 20px 0;">
            </td>
        </tr>
        
        <!-- Body Content -->
        <tr>
            <td style="padding: 20px; color: #333333;">
                <p>Hai,</p>
                <p>Kami telah menerima permintaan untuk menyetel ulang kata sandi untuk akun PelatihanKu yang terkait dengan email ini.</p>
                <p>Anda dapat menyetel ulang kata sandi menggunakan kode OTP di bawah ini:</p>
                <h2 style="text-align: center; color: #FF9228; margin: 15px 0;"> ' . htmlspecialchars($otp) . '</h2>
                <p>Jika Anda tidak meminta untuk mengubah kata sandi, Anda dapat mengabaikan email ini, dan kata sandi Anda tidak akan diubah.</p>
                <small>Kode OTP ini hanya berlaku selama 1 jam setelah dikirim.</small>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td>
                <hr style="border: none; border-top: 1px solid #aaa8a856; margin: 20px 0;">
            </td>
        </tr>
        <tr>
            <td style="text-align: center; font-size: 0.9rem; color: #7D7D7D; padding-bottom: 10px;">
                <p style="margin: 0;">© 2024 Balai Latihan Kerja. All rights reserved.</p>
                <p style="margin: 5px 0;">
                    Jika Anda membutuhkan bantuan, hubungi kami di <a href="mailto:support@balailatihankerja.com" style="color: #FF9228; text-decoration: none;">support@balailatihankerja.com</a>. Kami siap membantu Anda.
                </p>
            </td>
        </tr>
    </table>
</body>';
            $mail->send();
            return [
                'success' => true,
                'message' => 'Kode OTP berhasil dikirim!',
                'token' => $token,
                'isEmpty' => false,
                'redirect' => '/password-reset/verify'
            ];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $mail->ErrorInfo];
        }
    }
}
