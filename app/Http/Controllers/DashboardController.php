<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Sale::sum('total_price');
        $booksSold = Sale::sum('quantity');
        $lowStockBooks = Book::where('stock', '<', 5)->get();
        $popularCategories = Book::join('sales', 'books.id', '=', 'sales.book_id')
            ->selectRaw('books.category, SUM(sales.quantity) as total_sales')
            ->groupBy('books.category')
            ->orderByDesc('total_sales')
            ->take(3)
            ->get();

        return view('dashboard.index', compact('totalRevenue', 'booksSold', 'lowStockBooks', 'popularCategories'));
    }
}