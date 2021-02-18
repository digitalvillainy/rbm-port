<?php

/* Generated by neoan3-cli */

namespace Neoan3\Components;

use Neoan3\Apps\Hcapture;
use Neoan3\Frame\RbmPort;
use SendGrid;
use SendGrid\Mail\Mail;

/**
 * Class Contact
 * @package Neoan3\Components
 */

class Contact extends RbmPort{
    /**
     * POST: api.v1/contact
     * @param array $emailForm
     * @return false[]
     * @throws \SendGrid\Mail\TypeException
     * @throws \Exception
     */
    function postContact(array $emailForm): array
    {
        $human = Hcapture::isHuman($emailForm);
        if ($human) {
            $this->credentials = getCredentials();
            $apiKey = $this->credentials['rbm_sendgrid']['SENDGRID_API_KEY'];
            $email = new Mail();
            $email->setFrom($emailForm['clientEmail'], "Potential Client");
            $email->setSubject($emailForm['subject']);
            $email->addTo('rrivera@redbannermedia.com', "Roberto Rivera");
            $email->addContent("text/plain", $emailForm['body']);
            $sendgrid = new SendGrid($apiKey);

            try {
                $response = $sendgrid->send($email);
                print $response->statusCode() . "\n";
                print_r($response->headers());
                print $response->body() . "\n";
            } catch (\Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }
        } else {
            return ['error' => false ];
        }
        return ['msg'=> true];
    }
}
