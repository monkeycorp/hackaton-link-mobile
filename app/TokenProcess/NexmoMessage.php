<?php
namespace App\TokenPrecess;

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;
/**
 * Created by PhpStorm.
 * User: juancarlosjosecamacho
 * Date: 10/28/17
 * Time: 22:01
 */
class NexmoMessage
{
    public function execute($params){
        $sid = 'AC3b5942277f0aa9b0c85b9d1f35df3911';
        $token = '294dac20f1df670ade47819a75e29632';
        $client = new Client($sid, $token);
        $client->messages->create(
            '+52'.$params['phone_number'],
            array(
                'from' => '+15204412341',
                'body' => $params['token'],
            )
        );

        /*try {
            $client = new Client();
            $request = $client->request('POST', 'https://rest.nexmo.com/sms/json', [
                    'api_key' => 'd21665d5',
                    'api_secret' => '93d509957a2a1d96',
                    'to' => '5569121379',
                    'from' => 'NEXMO',
                    'text' => 'Hello from Nexmo'
            ]);
            $response = $client->send($request);
            dd($response->getBody());
        } catch (RequestException $e) {
            dd($e->getRequest());
        }*/

        /*
        curl -X POST  https://rest.nexmo.com/sms/json \
        -d api_key=d21665d5 \
        -d api_secret=93d509957a2a1d96 \
        -d to=525548856498 \
        -d from="NEXMO" \
        -d text="Hello from Nexmo"
        print_r($client);*/
    }
}