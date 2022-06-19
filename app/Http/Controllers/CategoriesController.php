<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'acak' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'name' => 'required|min:4',
            'rgks' => 'required|min:4',
            'ktrg' => 'required|min:4'
        ]);
        $acak = $request->file('acak');
        $acak->storeAs('public/categories', $acak->hashName());
        Category::create([
            'acak' => $acak->hashName(),
            'name' => $request->name,
            'rgks' => $request->rgks,
            'ktrg' => $request->ktrg,
        ]);
        return redirect()->route('categories.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'acak' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            "name" => 'required|min:4',
            'rgks' => 'required|min:4',
            'ktrg' => 'required|min:4'
        ]);
        if ($request->hasFile('acak')) {
            $acak = $request->file('acak');
            $acak->storeAs('public/categories', $acak->hashName());
            Storage::delete('public/categories' . $category->acak);
            $category->update([
                'acak' => $acak->hashName(),
                'name' => $request->name,
                'rgks' => $request->rgks,
                'ktrg' => $request->ktrg,
            ]);
        } else {
            $category->update([
                'name' => $request->name,
                'rgks' => $request->rgks,
                'ktrg' => $request->ktrg,
            ]);
        }
        return redirect()->route('categories.index')->with(['success' => 'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::delete('public/categories' . $category->acak);
        $category->delete();
        return redirect()->route('categories.index')->with(['success' => 'Data berhasil dihapus']);
    }
}