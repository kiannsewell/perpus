<?php

namespace App\Http\Livewire;

use App\Models\Setting as Model;

use Livewire\Component;

class Setting extends Component
{

	public $setting;

	protected $rules = [
		'setting.name' => 'required|string',
		'setting.fine' => 'required|integer|min:0'
	];

	public function save()
	{
		$this->validate();
		$this->setting->save();

		session()->flash('success', 'Sukses Menyimpan Pengaturan');
	}

	public function mount(Model $setting)
	{
		$this->setting = $setting->first();
	}

    public function render()
    {
        return view('livewire.setting');
    }
}
