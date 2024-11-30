<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('books.create');
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validasi gambar
        ]);

        $coverImagePath = $request->file('cover_image') ? $request->file('cover_image')->store('covers', 'public') : null;

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'cover_image' => $coverImagePath,
        ]);

        return redirect()->route('books.index');
    }

    // Menampilkan form edit buku
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Mengupdate buku
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validasi gambar
        ]);

        $coverImagePath = $request->file('cover_image') ? $request->file('cover_image')->store('covers', 'public') : $book->cover_image;

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'cover_image' => $coverImagePath,
        ]);

        return redirect()->route('books.index');
    }

    // Menghapus buku
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
