<?php

namespace App\Http\Controllers;

use App\Models\News;
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
        return view('news.create');
    }

    // Store new "news" data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        News::create($formFields);

        return redirect('/')->with('message', 'News created successfully!');
    }

    // Show edit form
    public function edit(News $news) {
        return view('news.edit', [
            'news' => $news
        ]);
    }

    // Update news
    public function update(News $news, Request $request) {
        // Make sure that logged in user is owner of news
        if($news->user_id != auth()->id()) {
            abort(403, 'Unauthorized action!');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

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

    // Manage news
    public function manage() {
        return view('news.manage', [
            'news' => auth()->user()->news()->get()
        ]);
    }
} 
