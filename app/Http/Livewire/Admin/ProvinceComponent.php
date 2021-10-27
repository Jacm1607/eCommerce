<?php

namespace App\Http\Livewire\Admin;

use App\Models\Municipality;
use App\Models\Province;
use Livewire\Component;

class ProvinceComponent extends Component
{
    protected $listeners = ['delete'];

    public $province, $municipalities, $municipality;

    public $createForm = [
        'name' => '',
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
    ];

    public function mount(Province $province){
       if (auth()->user()->can('municipality.index')) {
            $this->province = $province;
            $this->getMunicipality();
       } else {
           abort(403);
       }
    }

    public function getMunicipality(){
        $this->municipalities = Municipality::where('province_id', $this->province->id)->get();
    }

    public function save(){
        if (auth()->user()->can('municipality.store')) {
            $this->validate([
                "createForm.name" => 'required',
            ]);
            $this->province->municipalities()->create($this->createForm);

            $this->reset('createForm');

            $this->getMunicipality();

            $this->emit('saved');
        } else {
            abort(403);
        }

    }

    public function edit(Municipality $municipality){
        $this->municipality = $municipality;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $municipality->name;
    }

    public function update(){
        if (auth()->user()->can('municipality.update')) {
            $this->municipality->name = $this->editForm['name'];
            $this->municipality->save();
            $this->reset('editForm');
            $this->getMunicipality();
        } else {
            abort(403);
        }
    }

    // public function delete(Municipality $municipality){
    //     $municipality->delete();
    //     $this->getMunicipality();
    // }

    public function render()
    {
        return view('livewire.admin.province-component')->layout('layouts.admin');
    }
}
