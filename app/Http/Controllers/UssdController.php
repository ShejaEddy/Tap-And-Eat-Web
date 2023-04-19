<?php

namespace App\Http\Controllers;

use App\Http\Ussd\States\Welcome;
use Illuminate\Http\Request;
use Sparors\Ussd\Facades\Ussd;

class UssdController extends Controller
{
    public function ussdRequest(Request $request)
    {
        if (!$request->text)
            $request["text"] = "";
        $request["sessionId"]=  "123452392393358020937022223";
//        $request["phoneNumber"]=  $request["phoneNumber"];
        $ussd = Ussd::machine()
            ->setFromRequest([
                'network',
                'phone_number' => "phoneNumber",
                'phone' => "phoneNumber",
                'sessionId' => "sessionId",
                'input' => "text"
            ])
            ->setInitialState(Welcome::class)
            ->setResponse(function (string $message, string $action) {
                return "$message";
            });
        return $ussd->run();
    }
}
