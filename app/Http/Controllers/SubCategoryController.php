<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $subcategories = SubCategory::latest()->paginate(5);
        $subcategories = SubCategory::select('sub_categories.*', 'categories.name as category')->join('categories', 'categories.id', '=', 'sub_categories.category_id')->latest()->paginate(5);
        return view('subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Create';
        $categories = Category::select('*')->get();
        return view('subcategories.createOrUpdate')
            ->with('categories', $categories)
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
        $this->validate($request, [
            'name' => 'required|min:4',
            'category_id' => 'required',
            // 'acak' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            // 'rgks' => 'required|min:4',
            // 'ktrg' => 'required|min:4'
        ]);
        $acak = $request->file('acak');
        // $acak->storeAs('public/subcategories', $acak->hashName());
        SubCategory::create([
            'name' => $request->name, 'category_id' => $request->category_id,
            // 'acak' => $acak->hashName(),
            // 'rgks' => $request->rgks,
            // 'ktrg' => $request->ktrg,
        ]);
        return redirect()->route('subcategories.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = SubCategory::select('sub_categories.*', 'categories.name as category')->join('categories', 'categories.id', '=', 'sub_categories.category_id')->find($id);
        return view('subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $text = 'Edit';
        $categories = Category::select('*')->get();
        return view('subcategories.createOrUpdate', compact('subcategory'))
            ->with('categories', $categories)
            ->with('text', $text);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $this->validate($request, [
            "name" => 'required|min:4',
            // 'acak' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            // 'rgks' => 'required|min:4',
            // 'ktrg' => 'required|min:4'
        ]);
        if ($request->hasFile('acak')) {
            $acak = $request->file('acak');
            $acak->storeAs('public/subcategories', $acak->hashName());
            Storage::delete('public/subcategories' . $subcategory->acak);
            $subcategory->update([
                'name' => $request->name, 'category_id' => $request->category_id,
                // 'acak' => $acak->hashName(),
                // 'rgks' => $request->rgks,
                // 'ktrg' => $request->ktrg,
            ]);
        } else {
            $subcategory->update([
                'name' => $request->name, 'category_id' => $request->category_id,
                // 'rgks' => $request->rgks,
                // 'ktrg' => $request->ktrg,
            ]);
        }
        return redirect()->route('subcategories.index')->with(['success' => 'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subcategory)
    {
        Storage::delete('public/subcategories' . $subcategory->acak);
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with(['success' => 'Data berhasil dihapus']);
    }
}