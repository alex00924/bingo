<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole("admin")) {
                return redirect(route("card.list"));
            }
        }
        return redirect(route("order.new"));
    }
}
