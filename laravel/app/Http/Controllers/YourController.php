<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class YourController extends Controller
{
    // menyiapkan tempat
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    // menampilkan data
    public function show($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    // menambahkan data
    public function store(Request $request)
    {
        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    // update item
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->update($request->all());
        return response()->json($item, 201);
    }

    // menghapus data
    public function destroy($id)
    {
        Item::destroy($id);
        return response()->json(null, 204);
    }
}
