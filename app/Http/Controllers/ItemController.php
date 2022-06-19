<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::select('items.*', 'categories.name as category', 'sub_categories.name as subcat')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_category_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
<<<<<<< HEAD
            ->latest('items.created_at')->paginate(5);
=======
            ->latest()->paginate(10);
>>>>>>> rina
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Create';
        $subcat = SubCategory::select('*')->get();
        return view('items.createOrUpdate')
            ->with('subcategories', $subcat)
            ->with('text', $text);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            // 'sub_category_id' => 'required',
        ]);
        $masuk = Item::create($request->all());
        $retVal = ($masuk) ? 'berhasil' : 'gagal maning';
        return redirect()->route('items.index')
            ->with('success', $retVal);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::select('items.*', 'sub_categories.name as subcat', 'categories.name as category')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_category_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->find($id);
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $text = 'Edit';
        $subcategories = SubCategory::select('*')->get();
        return view('items.createOrUpdate', compact('item'))
            ->with('subcategories', $subcategories)
            ->with('text', $text);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|min:4',
            // 'sub_category_id' => 'required',
        ]);
        $item->update($request->all());
        return redirect()->route('items.index')->with('success', 'item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}