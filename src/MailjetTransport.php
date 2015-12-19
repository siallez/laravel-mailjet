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
        $data = [];
        
        foreach ($message->getFrom() as $address => $display) {
            $data['FromEmail'] = $address;
            $data['FromName'] = $display != null ? $display : $address;
            break;
        }
        
        foreach ($message->getTo() as $address => $display) {
            $data['Recipients'][] = ['Email' => $address, 'Name' => $display];
        }
        
        $data['Subject'] = $message->getSubject();
        
        $data['Text-Part'] = $message->getBody(); //TODO: Text-Part & Html-Part
        
        return $data;
    }
}
