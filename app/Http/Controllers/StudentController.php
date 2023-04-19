<?php

namespace App\Http\Controllers;

use App\Http\Traits\UtilityTrait;
use App\Student;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    use UtilityTrait;

    public function indexApi()
    {
        $students = Student::latest()->get();
        return response()->json($students);

    }

    public function index()
    {
        $students = Student::latest()->get();
        return view('admin.students.index', compact('students'));
    }


    public function storeApi(Request $request)
    {
        $validator= \validator()->make($request->all(),[
            'name' => 'required|string',
            'phoneNumber' => 'required|unique:students',
            'card' => 'required|unique:students',
            'pin' => 'required|string',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return response()->json($response, 400);
        }

        $pin = $request->pin;

        $student = Student::create([
            'name' => $request['name'],
            'phoneNumber' => $request['phoneNumber'],
            'pin' => $pin,
            'card' => $request['card'],
        ]);

        return response()->json($student);
    }

    public function opayPaymentResponse(Request $request)
    {
        $trans = Transaction::where("transaction_id", $request["transactionId"])->first();
        if ($request["status"] != "SUCCESS") {
            $trans->status = "FAILED";
            $trans->save();
            return response(["message" => "transaction failed"]);
        }
        $trans->status = "SUCCESS";
        $student = Student::find($trans->student_id);
        $student->balance = $student->balance + $trans->amount;
        $trans->save();
        $student->save();
        $this->sendSMS($student->phoneNumber,
            $student->name . " your transaction of " . $trans->amount . " was successful. Your new balance is " . $student->balance);

        return response(["message" => "Ok"]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
