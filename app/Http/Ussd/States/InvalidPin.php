<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class InvalidPin extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('END Invalid PIN')
            ->lineBreak(3)
            ->line('You entered invalid PIN')
            ->lineBreak(2);
    }

    protected function afterRendering(string $argument): void
    {

    }
}
