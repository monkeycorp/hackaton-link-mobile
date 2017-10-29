<?php

namespace App\Http\Controllers;

use App\TokenPrecess\TokenProcessFacade;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateUserController extends Controller
{
    protected $user;
    protected $tokenProcess;
    public function __construct(User $user, TokenProcessFacade $tokenProcess)
    {
        $this->user = $user;
        $this->tokenProcess = $tokenProcess;
    }

    public function index(){
        return response()->json('a');
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
            'phone_number' => 'required|max:10|min:10',
            'card' => 'required|max:16|min:16',
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),200);
        }
        $user = $this->user->existUser($request->all());
        if(count($user) > 0) {
            $this->tokenProcess->execute($user[0]);
            return response()->json(['msg'=> 'success'], 200);
        }
        return response()->json(['msg'=> 'error'], 200);
    }
}
