<?php

namespace App\Livewire;

use App\Livewire\Forms\ScanForm;
use App\Models\Presence;
use App\Models\Student;
use Carbon\Carbon;
use Livewire\Component;

class Scan extends Component
{
    public ScanForm $form;

    private function updateSuccessStatus($time){
        Carbon::setLocale('id');    
        $tf = Carbon::parse($time);
        $stf = Carbon::createFromFormat('H:i', '07:10');
        $diff = $stf->diff($tf);
        if($tf->lessThan($stf)){
            return $this->dispatch('show-status','success','check-circle.svg','Anda datang Tepat Waktu!');
        } else {
            return $this->dispatch('show-status','danger','clock-history.svg','Anda Terlambat ('.$diff.')!');
        }
    }

    private function updateAttempts($presence){
        Carbon::setLocale('id');
        $tf = Carbon::now();
        $stf = Carbon::parse($presence->updated_at)->addSeconds(30);
        //dd($tf->toString(),$stf->toString());
        if($tf->lessThan($stf)){
            $presence->attempts--;
            $presence->update();
            if($presence->attempts == '0'){
                return $this->dispatch('show-status','dark','slash-circle.svg','ID is blocked!');
            } else {
                return $this->dispatch('show-status','warning','exclamation-diamond.svg','ID Already been scanned today, You have '.$presence->attempts.' attempt(s) left!');
            }
        } else {
            $presence->attempts = 3;
            $presence->updated_at = $tf;
            $presence->update();
            return $this->dispatch('show-status','warning','exclamation-diamond.svg','ID Already been scanned today, You have '.$presence->attempts.' attempt(s) left!');
        }
    }

    public function scan(){
        $this->validate();
        $rfid = $this->form->rfid;
        $student = Student::with('presences')->where('rfid',$rfid)->first();
        if(!$student){
            $this->dispatch('show-status','warning','exclamation-diamond.svg','ID Tidak Ditemukan!');
            return $this->dispatch('rfid-scanned',null);
        }
        if($student->presences()->exists()){
            $latestPresence = $student->presences()->orderBy('created_at','asc')->first();
            if($latestPresence->attempts == '0'){
                $this->dispatch('show-status','dark','slash-circle.svg','ID is blocked!');
                return $this->dispatch('rfid-scanned',null);
            }
        }
        $today = Carbon::today()->setTimezone('Asia/Jakarta')->toDateString();
        $todaysPresence = $student->presences()->whereDate('created_at',$today)->first();
        if($todaysPresence){
            $this->updateAttempts($todaysPresence);
            return $this->dispatch('rfid-scanned',$student->id);
        }

        $presence = Presence::create([
            'student_id' => $student->id,
        ]);
        $this->updateSuccessStatus($presence->created_at);
        return $this->dispatch('rfid-scanned',$student->id);
    }

    public function render()
    {
        return view('livewire.scan');
    }
}
