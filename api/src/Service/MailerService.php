<?php
/**
 * Created by PhpStorm.
 * User: aminejerbouh
 * Date: 20/08/2019
 * Time: 10:25
 */

namespace App\Service;

use \Mailjet\Resources;
use \Mailjet\Client as Client;

class MailerService
{
    /**
     * @param $to
     * @param $firstname
     * @return bool
     */
    public function sendNewUserMail($to, $firstname)
    {
        $mailJet = new Client(getenv('MAILJET_APIKEY_PUBLIC'), getenv('MAILJET_APIKEY_PRIVATE'), true, ['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => getenv('SENDER_EMAIL'),
                        'Name' => "Equipe eMotion"
                    ],
                    'To' => [
                        [
                            'Email' => $to,
                            'Name' => $firstname
                        ]
                    ],
                    'Subject' => "Bienvenue sur eMotion !",
                    'TextPart' => "Bienvenue sur eMotion !",
                    'HTMLPart' => "<h1>Bonjour $firstname</h1> <p>Bienvenue sur le site eMotion !</p>"
                ]
            ]
        ];
        $response = $mailJet->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }

    public function sendNewCheckoutMail($to, $firstname)
    {
        $mailJet = new Client(getenv('MAILJET_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'), true, ['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => getenv('SENDER_EMAIL'),
                        'Name' => "Equipe eMotion"
                    ],
                    'To' => [
                        [
                            'Email' => $to,
                            'Name' => $firstname
                        ]
                    ],
                    'Subject' => "Bienvenue sur eMotion !",
                    'TextPart' => "Bienvenue sur eMotion !",
                    'HTMLPart' => "<h1>Bonjour $firstname</h1> <p>Merci d'avoir réservé chez eMotion</p> <p>Vous trouverez ci-joint votre facture concernant votre commande</p>"
                ]
            ]
        ];
        $response = $mailJet->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }
}