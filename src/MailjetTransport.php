<?php

namespace Siallez\Mailjet;

use Illuminate\Mail\Transport\Transport;
use Swift_Mime_Message;

class MailjetTransport extends Transport
{
    protected $client;

    public function __construct(\Mailjet\Client $client)
    {
        $this->client = $client;
    }

    public function send(Swift_Mime_Message $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);
        
        $email = $this->buildEmailData($message);
        
        return $this->client->post(\Mailjet\Resources::$Email, ['body' => $email]);
    }
    
    protected function buildEmailData(Swift_Mime_Message $message)
    {
        list($FromName, $FromEmail, $Recipients, $Subject) = [null, null, null, null];
        
        foreach ($message->getFrom() as $address => $display) {
            $FromName = $display;
            $FromEmail = $address;
            break;
        }
        
        foreach ($message->getTo() as $address => $display) {
            $Recipients[] = ['Email' => $address, 'Name' => $display];
        }
        
        $Subject = $message->getSubject();
        
        $email = [ //TODO: Text-Part & Html-Part
            'Text-Part' => $message->getBody(),
        ];
        
        return array_merge(compact('FromName', 'FromEmail', 'Subject', 'Recipients'), $email);
    }
}
