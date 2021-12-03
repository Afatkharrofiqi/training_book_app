<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book.index', [
            'books' => Book::with('categories')->paginate(10) // lazy load
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create', [
            'category' => Category::all()
        ]);
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
            'judul' => 'required|min:4',
            'tahun' => 'required|numeric',
            'cover' => 'mimes:png,jpg|max:10000',
        ]);

        $book = new Book();
        $book->judul = $request->judul;
        $book->tahun = $request->tahun;
        $file = $request->file('cover');
        if($file) {
            $imagePath = $file->storeAs('book_cover', $file->getClientOriginalName(), 'public');
            $book->cover = $imagePath;
        }
        $book->save();

        $book->categories()->attach($request->category);

        return redirect()->route('book.index')->with('status', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required|min:4',
            'tahun' => 'required|numeric',
            'cover' => 'mimes:png,jpg|max:10000',
        ]);

        $book->judul = $request->judul;
        $book->tahun = $request->tahun;
        $file = $request->file('cover');
        if($file) {
            if($book->cover) {
                Storage::delete('public/'.$book->cover);
            }
            $imagePath = $file->storeAs('book_cover', $file->getClientOriginalName(), 'public');
            $book->cover = $imagePath;
        }
        $book->save();

        // $book->categories()->detach();
        // $book->categories()->attach($request->category);

        $book->categories()->sync($request->category);

        return redirect()->route('book.index')->with('status', 'Buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->categories()->detach();
        if($book->cover) {
            Storage::delete('public/'.$book->cover);
        }
        $book->delete();

        return redirect()->route('book.index')->with('status', 'Buku berhasil dihapus');
    }
}
