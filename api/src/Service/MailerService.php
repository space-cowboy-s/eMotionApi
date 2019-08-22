<?php
/**
 * Created by PhpStorm.
 * User: aminejerbouh
 * Date: 20/08/2019
 * Time: 10:25
 */

namespace App\Service;

use http\Url;
use \Mailjet\Resources;
use \Mailjet\Client as Client;

class MailerService
{
    /**
     * @param $to
     * @param $firstname
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

    /**
     * @param $to
     * @param $firstname
     */
    public function sendNewCheckoutMail($to, $firstname, $id)
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
                    'Subject' => "Vôtre réservation sur eMotion !",
                    'TextPart' => "Bienvenue sur eMotion !",
                    'HTMLPart' => "<h1>Bonjour $firstname</h1> <p>merci d'avoir reservé sur le site eMotion !</p> <p> vous trouverez ci-joint votre facture</p> <a href='api.atcreative.fr/checkout/pdf/" . $id . "' target=\"_blank\">votre facture</a>"
                ]
            ]
        ];
        $response = $mailJet->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }
}