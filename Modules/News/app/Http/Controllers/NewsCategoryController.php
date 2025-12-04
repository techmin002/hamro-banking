<?php

namespace Modules\News\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\News\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = NewsCategory::all();

        return view('news::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $slug = Str::slug($request->name);
        if ($request->image) {
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('upload/images/News_Categories'), $imageName);

        }
        NewsCategory::create([
            'name' => $request['name'],
            'slug' => $slug,
            'status' => $request['status'],
            'image' => $imageName,
            'parents_id' => $request['parents_id'],
        ]);

        // toastr('Blog Added','success');
        // return redirect()->route('blogs.index');
        return redirect()->route('categories.index')->with('success', 'Category Added Successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('news::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('news::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = NewsCategory::findOrFail($id);
        $slug = Str::slug($request->name);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && file_exists(public_path('upload/images/News_Categories/'.$category->image))) {
                unlink(public_path('upload/images/News_Categories/'.$category->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/images/News_Categories'), $imageName);
            $category->image = $imageName;
        }

        // Update other fields
        $category->name = $request->name;
        $category->slug = $slug;
        $category->parents_id = $request->parents_id;
        $category->status = $request->status;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = NewsCategory::findOrFail($id);

        // Delete image if exists
        if ($category->image && file_exists(public_path('upload/images/News_Categories/'.$category->image))) {
            unlink(public_path('upload/images/News_Categories/'.$category->image));
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully');
    }

    public function status($id)
    {
        $category = NewsCategory::findOrFail($id);

        // Toggle between 'on' and 'off' (or 'active'/'inactive')
        $category->status = $category->status === 'on' ? 'off' : 'on';
        $category->save();

        return redirect()->back()->with('success', 'Category status updated successfully');
    }
}
