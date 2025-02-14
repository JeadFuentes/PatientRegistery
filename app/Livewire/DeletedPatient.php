<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;
use Livewire\WithPagination;

class DeletedPatient extends Component
{
    use WithPagination;
    public $sortBy = 'id';
    public $sortDirection = 'desc';
    public $perPage = 5;
    public $search = '';


    public function restorePatient($id){
        $restorePatients = Patient::find($id);
        $validated = [
            'status' => 'Active',
        ];

        $restorePatients ->fill($validated);
        $restorePatients ->save();

        session()->flash('message', 'Patient Restored Successfully.Please Check it in Patients Registration');
        $this->redirect(route('trash'));
    }

    public function sortingBy($field){
        if ($this->sortDirection == 'asc'){
            $this->sortDirection = 'desc';
        }
        else{
            $this->sortDirection = 'asc';
        }
        
        return $this->sortBy = $field;
    }

    public function perPages(){
        //
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $patients = Patient::search($this->search)->where('status','Inactive')->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.deleted-patient', ['patients' => $patients]);
    }
}
