<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('user.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('user.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        session()->flash('success_message', 'Your category was created successfully');

        return redirect()->route('user.categories.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        return view('user.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('user.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
        ]);

        session()->flash('success_message', 'Your category was updated successfully');

        return redirect()->route('user.categories.index');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if($category->articles->count() > 0) {
            abort(403, 'This category has articles and cannot be deleted');
        };

        // Checking if a category can be deleted

        $category->delete();

        return redirect()->back();
    }
}
