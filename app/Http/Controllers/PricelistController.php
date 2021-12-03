<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BarangHarga;
use Illuminate\Http\Request;

class PricelistController extends Controller
{

    public function index()
    {
        $pricelist = Barang::all();
        // $pricelist = Barang::with(['satuan','category','subcategory'])->get();
        // $pricelist = Barang::with('categories,subcategories,satuans,barangharga');
        return view('pricelist.index', compact('pricelist'));
        // return view('pricelist.index', [
        //     "pricelist" => Barang::with(['satuan','category','subcategory'])->get()
        // ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
