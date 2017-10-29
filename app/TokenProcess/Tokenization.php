<?php
namespace App\TokenPrecess;
use App\Helpers\AlphaRandom;
use App\TemporalToken;

/**
 * Created by PhpStorm.
 * User: juancarlosjosecamacho
 * Date: 10/28/17
 * Time: 22:00
 */
class Tokenization {
    public $temporalToken;
    public function __construct(TemporalToken $temporalToken)
    {
        $this->temporalToken = $temporalToken;
    }

    public function execute($params){
        $now = new \DateTime();
        $now->modify('+5 minutes');
        $now = $now->format('Y-m-d H:i:s');
        $token = AlphaRandom::generate(4);

        $this->temporalToken->create([
            'token' => $token,
            'user_id' => $params['id'],
            'deleted_at' => $now
        ]);
        return $token;
    }
}