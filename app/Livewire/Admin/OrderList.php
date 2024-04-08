<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Orders;

class OrderList extends Component
{
    use WithPagination;
 
    public function render()
    {
        $orders = Orders::paginate(10);

        return view('livewire.admin.order-list', ['orders' => $orders])->layout('layouts.admin');
    }
}
