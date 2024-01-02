<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
class HomeController extends Controller
{
    //
    public function index()
    {
        $Barang = Barang::all();
        return view('home',['Barang' => $Barang]);
    }
}
