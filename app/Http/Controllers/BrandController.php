<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
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
        $brands = Brand::latest()->paginate(5);
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Create';
        return view('brands.createOrUpdate')->with('text',);
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
            // 'acak' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'name' => 'required|min:5',
            'rgks' => 'required|min:5',
            'ktrg' => 'required|min:10'
        ]);
        $acak = $request->file('acak');
        // $acak->storeAs('public/brands', $acak->hashName());
        Brand::create([
            // 'acak' => $acak->hashName(),
            'name' => $request->name,
            'rgks' => $request->rgks,
            'ktrg' => $request->ktrg,
        ]);
        return redirect()->route('brands.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'acak' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            "name" => 'required|min:5',
            'rgks' => 'required|min:5',
            'ktrg' => 'required|min:10'
        ]);
        if ($request->hasFile('acak')) {
            $acak = $request->file('acak');
            $acak->storeAs('public/brands', $acak->hashName());
            Storage::delete('public/brands' . $brand->acak);
            $brand->update([
                'acak' => $acak->hashName(),
                'name' => $request->name,
                'rgks' => $request->rgks,
                'ktrg' => $request->ktrg,
            ]);
        } else {
            $brand->update([
                'name' => $request->name,
                'rgks' => $request->rgks,
                'ktrg' => $request->ktrg,
            ]);
        }
        return redirect()->route('brands.index')->with(['success' => 'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        Storage::delete('public/brands' . $brand->acak);
        $brand->delete();
        return redirect()->route('brands.index')->with(['success' => 'Data berhasil dihapus']);
    }
}