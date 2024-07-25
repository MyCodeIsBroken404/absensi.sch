<?php

namespace App\Livewire;

use App\Models\Student;
use Carbon\Carbon;
use Livewire\Component;

class MainMonitor extends Component
{
    public $students;
    public $today;
    public $x;
    public $refreshMode;

    public function mount(){
        $r = $this->refreshMode;
        if($r == 'refreshStudents'){
            $this->refreshStudents();
        }
    }

    public function refreshStudents(){
        $timezone = 'Asia/Jakarta';
        $this->today = Carbon::today();
        $this->x = 0;
        $this->students = Student::with(['grade', 'presences' => function($query){
            $query->where('attempts',0)
            ->orWhereDate('created_at',$this->today);
        }])
        ->get();
        //dd($this->students->toArray(), $this->x);
    }

    public function openDetail($id){
        $this->dispatch('open-detail',$id);
    }

    public function render()
    {
        return view('livewire.main-monitor');
    }
}
