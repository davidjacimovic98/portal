<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function softDelete(Category $category) {
        $category->delete();

        // Optionally, redirect or return a response to indicate success
        return redirect('/')->with('message', 'Category soft deleted successfully');
    }

    public function trashed() {
        $categories = Category::onlyTrashed()->get();

        return view('categories.trashed', compact('categories'));
    }

    public function restore(Category $category) {
        $category->restore();

        // Restore associated news
        $category->news()->restore();

        // Optionally, redirect or return a response to indicate success
        return redirect()->back()->with('message', 'Category and associated news restored successfully');
    }
}
