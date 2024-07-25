<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class StatusInfo extends Component
{
    public $color;
    public $icon;
    public $message;

    #[On('show-status')]
    public function showStatus($c,$i,$m){
        $this->icon = $i;
        $this->color = $c;
        $this->message = $m;
    }

    public function render()
    {
        return view('livewire.status-info');
    }
}
