<?php

namespace App\Http\Controllers;

use App\Models\RegistruEntry;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('registru.index');
    }
}
