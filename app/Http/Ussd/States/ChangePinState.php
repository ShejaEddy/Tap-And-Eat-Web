<?php

namespace App\Http\Ussd\States;

use App\Student;
use Sparors\Ussd\State;

class ChangePinState extends State
{
    protected function beforeRendering(): void
    {
        //
        $this->menu->text('CON Enter your new pin');
    }

    protected function afterRendering(string $argument): void
    {
        $explodedString = explode("*", $argument);
        $text = $explodedString[count($explodedString) - 1];
        Student::where('phoneNumber', $this->record->phoneNumber)->update(['pin' => $text]);
        $this->decision
            ->any(PinChangedState::class);
    }
}
