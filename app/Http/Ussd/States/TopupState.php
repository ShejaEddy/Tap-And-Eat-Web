<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class TopupState extends State
{
    protected function beforeRendering(): void
    {
        // asks the user to enter amount to top up

        $this->menu->text('CON Enter amount to topup')
            ->lineBreak(3);

    }

    protected function afterRendering(string $argument): void
    {
        $explodedString = explode("*", $argument);
        $text = $explodedString[count($explodedString) - 1];
        $this->record->set("topup_amount", $text);
        $this->decision
            ->any(ConfirmPaymentState::class);
    }
}
