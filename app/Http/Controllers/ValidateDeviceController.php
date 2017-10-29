<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ValidateDeviceController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emmiter_phone' => 'required|max:10|min:10|exists:white_lists,phone_number',
            'token' => 'required|max:4|min:4',
            'phone_number' => 'required|max:10|min:10',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),200);
        }
        $tokens = $this->user->validateDevice($request->all());
        if(count($tokens) > 0){
            $user = $this->user->updateCurrentToken($request->all());
            return response()->json(['msg'=> 'success', 'token' => $user->token], 200);
        }
        return response()->json(['msg'=> 'error'], 200);
    }
}
