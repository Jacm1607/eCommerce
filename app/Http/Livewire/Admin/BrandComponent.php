<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;

use Livewire\WithPagination;

class BrandComponent extends Component
{
    use WithPagination;

    public $brand;
    protected $listeners = ['delete'];

    public $createForm=[
        'name' => null
    ];

    public $editForm=[
        'open' => false,
        'name' => null
    ];

    public $rules = [
        'createForm.name' => 'required'
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'editForm.name' => 'nombre'
    ];

    public function save(){
        if (auth()->user()->can('brand.store')) {
            $this->validate();
            Brand::create($this->createForm);
            $this->reset('createForm');
            $this->render();
        } else {
            abort(403);
        }
    }

    public function edit(Brand $brand){
        $this->brand = $brand;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $brand->name;
    }

    public function update(){
        if (auth()->user()->can('brand.update')) {
            $this->validate([
                'editForm.name' => 'required'
            ]);
            $this->brand->update($this->editForm);
            $this->reset('editForm');
            $this->render();
        } else {
            abort(403);
        }
    }

    public function delete(Brand $brand){
        $brand->update(['brand_status' => '0']);
        $this->render();
    }

    public function render()
    {
        if (auth()->user()->can('brand.index')) {
            return view('livewire.admin.brand-component', ['brands' => Brand::where('brand_status', '1')->paginate(10)])->layout('layouts.admin');
        } else {
            abort(403);
        }

    }
}
