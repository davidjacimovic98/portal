<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // All news
    public function index() {
        return view('news.index', [
            'news' => News::orderBy('created_at','desc')->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Single news
    public function show(News $news) {
        return view('news.show', [
            'news' => $news
        ]);
    }

    // Show create form
    public function create() {
        return view('news.create', [
            'tags' => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    // Store new "news" data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
    
        // Combine existing tags if any are selected
        $selectedTags = $request->input('existing_tags', []);
        $tags = Tag::whereIn('id', $selectedTags)->pluck('name')->implode(',');

        $selectedCategory = $request->input('category_id');
    
        $formFields['tags'] = $tags;
        $formFields['category_id'] = $selectedCategory;
    
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
    
        $formFields['user_id'] = auth()->id();
    
        News::create($formFields);
    
        return redirect('/')->with('message', 'News created successfully!');
    }    

    // Show edit form
    public function edit($id) {
        $news = News::findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();
        $existingTagIds = explode(',', $news->tags);
    
        return view('news.edit', compact('news', 'tags', 'existingTagIds', 'categories'));
    }      

    // Update news
    public function update(Request $request, $id) {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
    
        // Combine existing tags if any are selected
        $selectedTags = $request->input('existing_tags', []);
        $tags = Tag::whereIn('id', $selectedTags)->pluck('name')->implode(',');

        $selectedCategory = $request->input('category_id');
    
        $formFields['tags'] = $tags;
        $formFields['category_id'] = $selectedCategory;
    
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
    
        $formFields['user_id'] = auth()->id();
    
        $news = News::findOrFail($id);
        $news->update($formFields);
    
        return redirect('/')->with('message', 'News updated successfully!');
    }

    // Delete news
    public function destroy(News $news) {
        // Make sure that logged in user is owner of news
        if($news->user_id != auth()->id()) {
            abort(403, 'Unauthorized action!');
        }
        
        $news->delete();

        return redirect('/')->with('message', 'News deleted successfully!');
    }

    // Categories
    public function categories() {
        $categories = Category::all();
        return view('news.categories', compact('categories'));
    }

    // Single category
    public function categoryNews(Category $category) {
        $news = $category->news;
        return view('news.category_news', compact('news', 'category'));
    }

    // Manage news
    public function manage() {
        return view('news.manage', [
            'news' => auth()->user()->news()->get()
        ]);
    }

    // Trashed news
    public function trash() {
        return view('news.trash', [
            'trashed_news' => auth()->user()->news()->onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(6)
        ]);
    }

    // Restore trashed news
    public function restore($id) {
        $news = News::withTrashed()->where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();

        if(!$news) {
            return redirect()->back();
        }

        // Make sure that logged in user is owner of news
        if($news->user_id != auth()->id()) {
            abort(403, 'Unauthorized action!');
        }

        $news->restore();

        return redirect()->route('news.trash')->with('message', 'News restored successfully.');
    }

    public function forceDelete($id) {
        $news = News::withTrashed()->where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();

        if(!$news) {
            return redirect()->back();
        }

        // Make sure that logged in user is owner of news
        if($news->user_id != auth()->id()) {
            abort(403, 'Unauthorized action!');
        }

        $news->forceDelete();

        return redirect()->route('news.trash')->with('message', 'News removed permanently.');
    }
} 
