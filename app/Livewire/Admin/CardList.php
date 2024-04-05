<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class CardList extends Component
{
    public function render()
    {
        return view('livewire.admin.card-list')->layout('layouts.admin');
    }
}
