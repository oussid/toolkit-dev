<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BusinessCard extends Component
{
    public $business;
    public $recontactDate;

    protected $rules = [
        'recontactDate' => 'required|after:yesterday',
    ];

    public function updatedRecontactDate () {
        $this->dispatchBrowserEvent('call-show-modal', ['modalId' => 'business-modal-'. $this->business->id]);
    } 


    public function markAsContacted () {
        $this->business->update([
            'status' => 1, 
            'contacted_by' => Auth::user()->id, 
            'contacted_at' => Carbon::now(), 
        ]);
    }

    public function contactLater () {
        // keep modal visible
        $this->dispatchBrowserEvent('call-show-modal', ['modalId' => 'business-modal-'. $this->business->id]);
        
        $this->validate();
        
        $this->business->update([
            'status' => 2,
            'recontact_at' => $this->recontactDate
        ]);
        // hide modal
        $this->dispatchBrowserEvent('call-hide-modal', ['modalId' => 'business-modal-'. $this->business->id]);
    }

    public function markAsUnavailable () {
        $this->business->update([
            'status' => 3,
        ]);
    }

    public function noAnswer () {
        $this->business->update([
            'status' => 4,
        ]);
    }

    public function render()
    {
        return view('livewire.business-card');
    }
}
