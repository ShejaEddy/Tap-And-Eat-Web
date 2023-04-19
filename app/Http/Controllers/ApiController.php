<?php

namespace App\Http\Controllers;

use App\CardValidation;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    private $MEAL_PRICE = 100;

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password))
                return response()->json(['message' => "Login succeed"], 200);
            else
                return response()->json(['message' => 'Invalid login credentials'], 401);
        }
        return response()->json(['message' => 'Invalid login credentials'], 401);
    }

    public function validateCard(Request $request)
    {
        $card = $request->card;
        $student = Student::where('card', $card)->first();
        if (!$student) {
            return response()->json(['message' => "Card is invalid"], 400);
        }
        // Check student's balance and if a student has enough balance to buy a meal
        if ($student->balance < $this->MEAL_PRICE) {
            return response()->json(['message' => "Insufficient balance"], 400);
        }

        CardValidation::create([
            'employee_id' => 1,
            'student_id' => $student->id,
            'amount' => $this->MEAL_PRICE,
        ]);
        // Update student balance
        $student->balance = $student->balance - $this->MEAL_PRICE;
        $student->save();
        return response()->json(['message' => "Card is valid"], 200);
    }

    public function validationsReport()
    {
         $validationsToday = CardValidation::whereDate('created_at', today())->count();
        $thisWeekValidations = CardValidation::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $thisMonthValidations = CardValidation::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $activeStudents = Student::where('balance', '>', 0)->count();
        $inactiveStudents = Student::where('balance', 0)->count();
        return response()->json([
            'validationsToday' => $validationsToday,
            'thisWeekValidations' => $thisWeekValidations,
            'thisMonthValidations' => $thisMonthValidations,
            'activeStudents' => $activeStudents,
            'inactiveStudents' => $inactiveStudents,
        ], 200);
    }

    public function history()
    {
        $validations = CardValidation::with("student")->latest()->get();
        return response()->json($validations, 200);
    }

}
