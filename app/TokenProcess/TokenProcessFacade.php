<?php
namespace App\TokenPrecess;

/**
 * Created by PhpStorm.
 * User: juancarlosjosecamacho
 * Date: 10/28/17
 * Time: 22:05
 */
class TokenProcessFacade
{
    private $message;
    private $temporalToken;
    public function __construct(NexmoMessage $nexmoMessage, Tokenization $tokenization)
    {
        $this->message = $nexmoMessage;
        $this->temporalToken = $tokenization;
    }

    public function execute($params) {
        $token = $this->temporalToken->execute($params);
        $this->message->execute(array(
           'token' => $token,
            'phone_number' => $params['phone_number']
        ));
    }
}