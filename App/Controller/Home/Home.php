<?php

namespace App\Controller\Home;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use App\Model\Home\Home as HomeModel;

require_once __DIR__ . '/../../../config-env.php';


class Home
{
    public static function get()
    {
        // Implementação da função GET
    }

    public static function post()
    {
        // Configurar o transporte de e-mail
        $transport = Transport::fromDsn('smtp://'.$_ENV['EMAIL_RESET_PASSWORD'].':'. $_ENV['PASSWORD_EMAIL_RESET'] .'@smtp.gmail.com');
        $mailer = new Mailer($transport);

        // Criar e configurar o e-mail
        $email = (new Email())
            ->from('bill.uba@gmail.com')
            ->to('bill.uba@gmail.com')
            ->subject('Solicitação para alterar senha')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        // Enviar o e-mail
        $mailer->send($email);
        HomeModel::post();
    }
}

?>