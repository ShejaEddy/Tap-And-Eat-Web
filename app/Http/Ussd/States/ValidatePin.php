<?php

namespace App\Http\Ussd\States;

use App\Http\Traits\UtilityTrait;
use Sparors\Ussd\State;

class ValidatePin extends State
{
    use UtilityTrait;

    protected function beforeRendering(): void
    {
        $this->menu->text('CON Validate your PIN')
            ->lineBreak(2)
            ->line('Please enter your PIN')
            ->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {
        $explodedString = explode("*", $argument);
        $text = $explodedString[count($explodedString) - 1];
        $studentValid = $this->verifyStudent($this->record->phoneNumber, $text);
        print($studentValid);

        if ($studentValid) {
            $record = $this->record->get("selected_menu");
            // if menu equals 1, go to topup balance, if 2, go to check balance, if 3, go to change pin
            if ($record == 1) {
                $this->decision->any(TopupState::class);
            } elseif ($record == 2) {
                $this->decision->any(CheckBalanceState::class);
            } elseif ($record == 3) {
                $this->decision->any(ChangePinState::class);
            } else
                $this->decision
                    ->any(Error::class);
        } else {
            $this->decision
                ->any(InvalidPin::class);
        }
    }
}
