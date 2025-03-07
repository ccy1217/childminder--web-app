<?php

namespace App\Livewire;

use Livewire\Component;

class PostcodeRoute extends Component
{
    public $startPostcode;
    public $endPostcode;

    public function render()
    {
        return view('livewire.postcode-route');
    }

    public function updated($propertyName)
    {
        $this->emit('routeUpdated', [
            'startPostcode' => $this->startPostcode,
            'endPostcode' => $this->endPostcode,
        ]);
    }
}
