<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;

class DetailsInfo extends Component
{
    public $student;

    #[On('open-detail')]
    public function showDetail($id){
        $this->student = Student::with(['grade','presences'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.details-info');
    }
}
