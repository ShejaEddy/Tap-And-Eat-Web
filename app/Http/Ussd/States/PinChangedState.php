<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class PinChangedState extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('END Your PIN has been modified successfully. Thank you for using our services');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
