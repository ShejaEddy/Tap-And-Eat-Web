<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class Welcome extends State
{
    protected function beforeRendering(): void
    {
        $phoneNumber = $this->record->phoneNumber;
        $student = \App\Student::where('phoneNumber', $phoneNumber)->first();
        if (!$student) {
            $this->menu->text('END You are not registered in our system. Please contact your school administrator. ');
            return;
        }

        $this->menu->text('CON Welcome To Tap & Eat.')
            ->lineBreak(2)
            ->line('What would you like to do?')
            ->listing([
                'Topup balance,',
                'Check balance,',
                'Change PIN.',
            ])
            ->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        $explodedString = explode("*", $argument);
        $text = $explodedString[count($explodedString) - 1];
        $this->record->set("selected_menu", $text);

        $this->decision->any(ValidatePin::class);
    }
}
