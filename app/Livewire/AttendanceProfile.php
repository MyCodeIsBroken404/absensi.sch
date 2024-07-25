<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendanceProfile extends Component
{
    public $curr_student;

    #[On('rfid-scanned')]
    public function rfid_scanned($id){
        $this->curr_student = Student::with('grade','presences')->find($id);
    }
    public function render()
    {
        return view('livewire.attendance-profile');
    }
}
