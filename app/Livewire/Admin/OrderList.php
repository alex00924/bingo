<?php

namespace App\Livewire\Admin;

use App\Livewire\OrderDetail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Orders;
use App\Models\OrderDetails;

class OrderList extends Component
{
    use WithPagination;
    
    public function clearData() {
        Orders::query()->truncate();
        OrderDetails::query()->truncate();
        $this->reset();
    }

    public function render()
    {
        $orders = Orders::paginate(10);

        return view('livewire.admin.order-list', ['orders' => $orders])->layout('layouts.admin');
    }
}
