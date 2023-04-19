<?php

namespace App\Http\Ussd\States;

use App\Student;
use Sparors\Ussd\State;

class CheckBalanceState extends State
{
    protected function beforeRendering(): void
    {
        $student=Student::where('phoneNumber', $this->record->phoneNumber)->first();
        $this->menu->text("CON Your balance is ".$student->balance." RWF");
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
