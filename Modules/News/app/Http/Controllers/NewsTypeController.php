<?php

namespace Modules\News\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\News\Models\NewsType;

class NewsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = NewsType::all();

        return view('news::types.index', compact('types'));
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

            $request->image->move(public_path('upload/images/News_Type'), $imageName);

        }
        NewsType::create([
            'name' => $request['name'],
            'slug' => $slug,
            'parents_id' => $request['parents_id'],
            'status' => $request['status'],
            'image' => $imageName,
        ]);

        // toastr('Blog Added','success');
        // return redirect()->route('blogs.index');
        return redirect()->route('types.index')->with('success', 'Type Added Successfully');
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
        $types = NewsType::findOrFail($id);
        $slug = Str::slug($request->name);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($types->image && file_exists(public_path('upload/images/News_Type/'.$types->image))) {
                unlink(public_path('upload/images/News_Type/'.$types->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/images/News_Type'), $imageName);
            $types->image = $imageName;
        }

        // Update other fields
        $types->name = $request->name;
        $types->slug = $slug;
        $types->parents_id = $request->parents_id;
        $types->status = $request->status;

        $types->save();

        return redirect()->route('types.index')->with('success', 'Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $types = NewsType::findOrFail($id);

        // Delete image if exists
        if ($types->image && file_exists(public_path('upload/images/News_Type/'.$types->image))) {
            unlink(public_path('upload/images/News_Type/'.$types->image));
        }

        $types->delete();

        return redirect()->route('types.index')->with('success', 'types Deleted Successfully');
    }

    public function status($id)
    {
        $types = NewsType::findOrFail($id);

        $types->status = $types->status === 'on' ? 'off' : 'on';
        $types->save();

        return redirect()->back()->with('success', 'types status updated successfully');
    }
}
