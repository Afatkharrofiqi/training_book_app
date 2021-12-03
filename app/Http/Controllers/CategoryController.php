<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        return view('category.index', [
            'categories' => Category::getAllCategoryWithPagination()
        ]);
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $request->validate([
            'name_category' => 'required|min:4|max:10|alpha_num'
        ], [
            'name_category.required' => 'Nama Kategori wajib diisi',
            'name_category.min'      => 'Nama Kategori :min karakter',
            'name_category.max'      => 'Nama Kategori :max karakter',
            'name_category.alpha_num'=> 'Nama Kategori harus terdiri dari huruf atau angka',
        ]);

        $category = new Category();
        $category->name = $request->name_category;
        $category->slug = Str::slug($request->name_category);
        $category->save();

        return redirect()->route('category.index')
            ->with('status', 'Category '.$request->name_category.' berhasil ditambahkan');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name_category' => 'required|min:4|max:10|alpha_num'
        ], [
            'name_category.required' => 'Nama Kategori wajib diisi',
            'name_category.min'      => 'Nama Kategori :min karakter',
            'name_category.max'      => 'Nama Kategori :max karakter',
            'name_category.alpha_num'=> 'Nama Kategori harus terdiri dari huruf atau angka',
        ]);

        $category = Category::findOrFail($id);
        $nama_lama = $category->name;
        $category->name = $request->name_category;
        $category->slug = Str::slug($request->name_category);
        $category->save();

        return redirect()->route('category.index')
            ->with('status', 'Category '.$nama_lama.' diubah ke '.$request->name_category.' berhasil diubah');
    }

    public function destroy($id){
        $category     = Category::findOrFail($id);
        $namaCategory = $category->name;
        $category->delete();

        return redirect()->route('category.index')
            ->with('status', 'Category '.$namaCategory. ' berhasil dihapus');
    }

    public function getAllCategory(){
        return Category::all();
    }
}
