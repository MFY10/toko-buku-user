<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::all(); // Ambil semua data buku
        return view('manage-books.index', compact('books'));
    }

    // Menampilkan form untuk menambahkan buku
    public function create()
    {
        return view('manage-books.create');
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $coverImage = null;
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => $coverImage,
        ]);

        return redirect()->route('manage.books');
    }

    // Menampilkan form untuk mengedit buku
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('manage-books.edit', compact('book'));
    }

    // Memperbarui buku
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = Book::findOrFail($id);
        $coverImage = $book->cover_image;

        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama
            if ($coverImage) {
                unlink(storage_path('app/public/' . $coverImage));
            }

            $coverImage = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => $coverImage,
        ]);

        return redirect()->route('manage.books');
    }

    // Menghapus buku
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover_image) {
            unlink(storage_path('app/public/' . $book->cover_image));
        }
        $book->delete();

        return redirect()->route('manage.books');
    }
}
