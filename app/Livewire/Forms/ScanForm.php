<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ScanForm extends Form
{
    #[Validate('required')]
    public $rfid = '';
}
