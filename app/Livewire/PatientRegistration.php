<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;
use Livewire\WithPagination;

class PatientRegistration extends Component
{
    use WithPagination;
    public $id;
    public $hrn;
    public $lastname;
    public $firstname;
    public $middlename;
    public $dob;
    public $civilstatus;
    public $sex;
    public $contact;
    public $street;
    public $citymun;
    public $barangay;
    public $district;
    public $zipcode;
    public $status;

    public $editPatients;
    public $deletePatients;
    public $viewPatients;

    public $sortBy = 'id';
    public $sortDirection = 'desc';
    public $perPage = 5;
    public $search = '';

    public function rules(){
        return [
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'dob' => 'required',
            'civilstatus' => 'required|string',
            'sex' => 'required|string',
            'contact' => 'required|numeric',
            'street' => 'required|string',
            'citymun' => 'required|string',
            'barangay' => 'required|string',
            'district' => 'required|string',
            'zipcode' => 'required|numeric',
        ];
    }

    public function createPatient(){
        $this->validate();

        Patient::create([
            'hrn' => 'SC'.date("YmdHism"),
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'dob' => $this->dob,
            'civilstatus' => $this->civilstatus,
            'sex' => $this->sex,
            'contact' => $this->contact,
            'street' => $this->street,
            'citymun' => $this->citymun,
            'barangay' => $this->barangay,
            'district' => $this->district,
            'zipcode' => $this->zipcode,
        ]);

        session()->flash('message', 'Patient Registered successfully.');
        //$this->dispatch('close-modal');
        $this->redirect(route('dashboard'));
    }

    public function editPatient($id){
        $this->editPatients = Patient::find($id);

        $this->id = $this->editPatients->id;
        $this->hrn = $this->editPatients->hrn;
        $this->lastname = $this->editPatients->lastname;
        $this->firstname = $this->editPatients->firstname;
        $this->middlename = $this->editPatients->middlename;
        $this->dob = $this->editPatients->dob;
        $this->civilstatus = $this->editPatients->civilstatus;
        $this->sex = $this->editPatients->sex;
        $this->contact = $this->editPatients->contact;
        $this->street = $this->editPatients->street;
        $this->citymun = $this->editPatients->citymun;
        $this->barangay = $this->editPatients->barangay;
        $this->district = $this->editPatients->district;
        $this->zipcode = $this->editPatients->zipcode;

        $this->dispatch('open-modal',  name : 'Register' );
    }

    public function viewPatient($id){
        $this->viewPatients = Patient::find($id);

        $this->hrn = $this->viewPatients->hrn;
        $this->lastname = $this->viewPatients->lastname;
        $this->firstname = $this->viewPatients->firstname;
        $this->middlename = $this->viewPatients->middlename;
        $this->dob = $this->viewPatients->dob;
        $this->civilstatus = $this->viewPatients->civilstatus;
        $this->sex = $this->viewPatients->sex;
        $this->contact = $this->viewPatients->contact;
        $this->street = $this->viewPatients->street;
        $this->citymun = $this->viewPatients->citymun;
        $this->barangay = $this->viewPatients->barangay;
        $this->district = $this->viewPatients->district;
        $this->zipcode = $this->viewPatients->zipcode;

        $this->dispatch('open-modal',  name : 'Register' );
    }

    public function saveEditPatient(){
        $editedPatient = Patient::find($this->id);
        $validated = $this->validate();

        $editedPatient->fill($validated);
        $editedPatient->save();

        session()->flash('message', 'Patient Edited successfully.');
        $this->redirect(route('dashboard'));
    }

    public function deletePatient($id){
        $this->deletePatients = Patient::find($id);

        $this->id = $this->deletePatients->id;
        $this->hrn = $this->deletePatients->hrn;
        $this->lastname = $this->deletePatients->lastname;
        $this->firstname = $this->deletePatients->firstname;
        $this->middlename = $this->deletePatients->middlename;

        $this->dispatch('open-modal',  name : 'Register' );
    }

    public function softDeletePatient(){
        $softDeletePatients = Patient::find($this->id);
        $validated = [
            'status' => 'Inactive',
        ];

        $softDeletePatients ->fill($validated);
        $softDeletePatients ->save();

        session()->flash('message', 'Patient Deleted successfully.');
        $this->redirect(route('dashboard'));
    }

    public function closePatient(){
        $this->viewPatients = null;
        $this->editPatients = null;
        $this->deletePatients = null;
        $this->dispatch('close-modal' );
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
        $patients = Patient::search($this->search)->where('status','Active')->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.patient-registration', ['patients' => $patients]);
    }
}
