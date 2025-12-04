<?php

namespace Modules\News\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\News\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $author = Author::all();

        return view('news::author.index', compact('author'));
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
        if ($request->image) {
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('upload/images/News_Author'), $imageName);

        }
        Author::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'status' => $request['status'],
            'image' => $imageName,
        ]);

        // toastr('Blog Added','success');
        // return redirect()->route('blogs.index');
        return redirect()->route('author.index')->with('success', 'Author Added Successfully');
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
        $author = Author::findOrFail($id);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($author->image && file_exists(public_path('upload/images/News_Author/'.$author->image))) {
                unlink(public_path('upload/images/News_Author/'.$author->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/images/News_Author'), $imageName);
            $author->image = $imageName;
        }

        // Update other fields
        $author->name = $request->name;
        $author->description = $request->description;
        $author->status = $request->status;

        $author->save();

        return redirect()->route('author.index')->with('success', 'Author Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        // Delete image if exists
        if ($author->image && file_exists(public_path('upload/images/News_Author/'.$author->image))) {
            unlink(public_path('upload/images/News_Author/'.$author->image));
        }

        $author->delete();

        return redirect()->route('author.index')->with('success', 'Author Deleted Successfully');
    }

    public function status($id)
    {
        $author = Author::findOrFail($id);

        $author->status = $author->status === 'on' ? 'off' : 'on';
        $author->save();

        return redirect()->back()->with('success', 'Author status updated successfully');
    }
}
