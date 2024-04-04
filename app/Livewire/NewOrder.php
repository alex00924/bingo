<?php

namespace App\Livewire;

use Livewire\Component;

class NewOrder extends Component
{
    public string $name = '';
    public string $city = '';
    public string $phone = '';
    public int $quantity = 1;
    public int $processStatus = 1;
    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'], //, 'regex:/([0-9]{9})[0-9]{9}/'
            'city' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'gt:0']
        ];
    }

    public function mount() {
        $this->name = auth()->user()->name;
        $this->city = auth()->user()->city;
        $this->phone = auth()->user()->phone;
    }

    public function nextStep() {
        if ($this->processStatus == 1) {
            $this->validate();
        }

        $this->processStatus += 1;
    }

    public function changeQuantity($amount = 1) {
        $this->quantity += $amount;
        $this->quantity = max(1, $this->quantity);
    }

    public function render()
    {
        return view('livewire.new-order');
    }
}
