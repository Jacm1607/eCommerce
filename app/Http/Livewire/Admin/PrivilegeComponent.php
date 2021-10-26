<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PrivilegeComponent extends Component
{
    public $privileges;

    protected $rules = [
        'createForm.name' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
    ];

    public $createForm = [
        'name' => null,
    ];

    public $editForm = [
        'open' => false,
        'name' => null,
    ];

    public function mount(){
        $this->getPrivileges();
    }

    public function getPrivileges(){
        $this->privileges = Permission::all();
    }

    public function save(){
        $this->validate();
        Permission::create(['name' => $this->createForm['name']]);
        $this->reset('createForm');
        $this->getPrivileges();
    }

    public function edit($id){
        $privilege = Permission::findOrFail($id);
        $this->resetValidation();
        $this->privilege = $privilege;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $privilege->name;

    }

    public function update(){
        $this->validate([
            'editForm.name' => 'required',
        ]);
        $this->privilege->update($this->editForm);
        $this->getPrivileges();
        $this->reset('editForm');

    }
    public function render()
    {
        return view('livewire.admin.privilege-component')->layout('layouts.admin');
    }
}
