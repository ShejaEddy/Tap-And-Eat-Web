<?php


namespace App\Http\Traits;


use App\Student;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait UtilityTrait
{

    public function sendSMS($phone, $sms)
    {
        $headers = [
            "Content-Type" => "application/json",
        ];
        $response = Http::withHeaders($headers)->get(env("SMS_URL"), http_build_query([
            "username" => "brdapp",
            "to" => "25" . $phone,
            "text" => $sms,
            "password" => "brdsms2190",
            "validityperiod" => 720,
            "smsc" => "rebsmsc",
            "from" => env("SMS_FROM"),
            "mclass" => 1,
        ]));
        return json_decode($response->body())->code == 200;
    }

    public function momoPay($tx_ref, $amount, $phoneNumber)
    {
        $URL = "https://opay-api.oltranz.com/opay/paymentrequest";
        $result = Http::post($URL, [
            "telephoneNumber" => "25" . $phoneNumber,
            "amount" => $amount,
            "organizationId" => env("OPAY_ORGANIZATION_ID"),
            "description" => "Payment",
            "callbackUrl" => env("BACKEND_HTTPS_URL") . "/api/opay/payment-response",
            "transactionId" => $tx_ref
        ]);
        Log::info("MOMO PAYMENT RESPONSE: " . $result->body(), ['result' => $result, 'orgId' => env("OPAY_ORGANIZATION_ID")]);
    }

    public function pay($amount, $phoneNumber)
    {
        $transactionId = uniqid();
        $student = Student::where('phoneNumber', $phoneNumber)->first();
        $this->momoPay($transactionId, $amount, $phoneNumber);
        Transaction::create(
            [
                "phone_number" => $phoneNumber,
                "transaction_id" => $transactionId,
                "amount" => $amount,
                "student_id" => $student->id
            ]
        );
    }

    public function verifyStudent($phoneNumber, $pin)
    {
        $student = Student::where('phoneNumber', $phoneNumber)->first();
        $pinValid = $pin == $student->pin;
        return $pinValid;
    }

    // function converts object into query string
    public function toQueryString($obj)
    {
        $query = http_build_query($obj);
        return $query;
    }
}
