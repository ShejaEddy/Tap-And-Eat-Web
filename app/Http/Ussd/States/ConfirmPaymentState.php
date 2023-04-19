<?php

namespace App\Http\Ussd\States;

use App\Http\Traits\UtilityTrait;
use Sparors\Ussd\State;

class ConfirmPaymentState extends State
{
    use UtilityTrait;

    protected function beforeRendering(): void
    {
        $amount = $this->record->get('topup_amount');

        $phoneNumber = $this->record->phoneNumber;
        $this->menu->text('END Please, confirm payment on your phone number of ' . number_format($amount) . ' RWF');
        $this->pay($amount, $phoneNumber);
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
