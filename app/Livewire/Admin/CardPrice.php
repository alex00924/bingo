<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class CardPrice extends Component
{
    public $price = 10;
    
    protected function rules()
    {
        return [
            'price' => ['required', 'numeric', 'gt:0']
        ];
    }
    public function mount() {
        $this->price = \App\Models\CardPrice::getPrice();
    }

    public function setPriceValue() {
        $this->validate();
        \App\Models\CardPrice::setPrice($this->price);
        $this->notify("Preço atualizado");
    }

    public function render()
    {
        return view('livewire.admin.card-price');
    }
}
