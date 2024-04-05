<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Orders;

class OrderDetail extends Component
{
    public $order;
    public function mount($id) {
        $this->order = Orders::with('orderDetails')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.order-detail');
    }
}
