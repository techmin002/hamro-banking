<?php

namespace Modules\News\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\News\Models\Author;
use Modules\News\Models\News;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\NewsImage;
use Modules\News\Models\NewsType;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        $authors = Author::all();
        $categories = NewsCategory::all();
        $types = NewsType::all();

        return view('news::news.index', compact('news', 'authors', 'categories', 'types'));
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
        try {
            // 1️⃣ Validation
            $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'nullable|integer|exists:news_categories,id',
                'types_id' => 'nullable|integer|exists:news_types,id',
                'author_id' => 'nullable|integer|exists:authors,id',
                'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
                'tags' => 'nullable|string',
                'short_description' => 'nullable|string',
                'description' => 'nullable|string',
                'news_section' => 'nullable|string',
                'schedule' => 'nullable|in:yes,no',
                'schedule_time' => 'nullable|date',
            ]);

            // 2️⃣ Prepare data (exclude fields handled separately)
            $data = $request->except(['thumbnail', 'tags', 'status']);

            // 3️⃣ Generate slug from title
            $data['slug'] = Str::slug($request->title);

            // 4️⃣ Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $uploadPath = public_path('upload/images/News');
                if (! file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $imageName = time().'.'.$request->thumbnail->extension();
                $request->thumbnail->move($uploadPath, $imageName);
                $data['thumbnail'] = $imageName;
            }

            // 5️⃣ Convert tags to JSON
            if ($request->tags) {
                $tagsArray = array_map('trim', explode(',', $request->tags));
                $data['tags'] = json_encode($tagsArray);
            }

            // 6️⃣ Handle status checkbox
            $data['status'] = $request->has('status') ? 'on' : 'off';

            // 7️⃣ Handle schedule_time format
            if (! empty($data['schedule_time'])) {
                $data['schedule_time'] = date('Y-m-d H:i:s', strtotime($data['schedule_time']));
            }

            // 8️⃣ Create the news record
            News::create($data);

            // 9️⃣ Redirect with success
            return redirect()->route('news.index')->with('success', 'News created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            // Log any other exception
            \Log::error('News Store Error: '.$e->getMessage());

            return redirect()->back()
                ->with('error', 'Something went wrong while creating news. Please try again.')
                ->withInput();
        }
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
        try {
            // 1️⃣ Find the news record
            $news = News::findOrFail($id);

            // 2️⃣ Prepare data (exclude fields handled separately)
            $data = $request->except(['thumbnail', 'tags', 'status']);

            // 3️⃣ Generate slug from title (optional: only if title changes)
            $data['slug'] = Str::slug($request->title);

            // 4️⃣ Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $uploadPath = public_path('upload/images/News');
                if (! file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $imageName = time().'.'.$request->thumbnail->extension();
                $request->thumbnail->move($uploadPath, $imageName);
                $data['thumbnail'] = $imageName;
            }

            // 5️⃣ Convert tags to JSON
            if ($request->tags) {
                $tagsArray = array_map('trim', explode(',', $request->tags));
                $data['tags'] = json_encode($tagsArray);
            }

            // 6️⃣ Handle status checkbox
            $data['status'] = $request->has('status') ? 'on' : 'off';

            // 7️⃣ Handle schedule_time
            if ($request->schedule == 'no') {
                $data['schedule_time'] = null; // Set to null if schedule is "no"
            } elseif (! empty($request->schedule_time)) {
                $data['schedule_time'] = date('Y-m-d H:i:s', strtotime($request->schedule_time));
            }

            // 8️⃣ Update the news record
            $news->update($data);

            // 9️⃣ Redirect with success
            return redirect()->route('news.index')->with('success', 'News updated successfully.');

        } catch (\Exception $e) {
            // Log any exception
            \Log::error('News Update Error: '.$e->getMessage());

            return redirect()->back()
                ->with('error', 'Something went wrong while updating news. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Delete image if exists
        if ($news->thumbnail && file_exists(public_path('upload/images/News/'.$news->thumbnail))) {
            unlink(public_path('upload/images/News/'.$news->thumbnail));
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'News Deleted Successfully');
    }

    public function status($id)
    {
        $news = News::findOrFail($id);

        // Toggle between 'on' and 'off' (or 'active'/'inactive')
        $news->status = $news->status === 'on' ? 'off' : 'on';
        $news->save();

        return redirect()->back()->with('success', 'News status updated successfully');
    }

    public function newsimages($id)
    {
        $news = News::findOrFail($id);
        $images = NewsImage::all();
        // dd($news);

        return view('news::news.newsimage', compact('news', 'images'));
    }

    public function newsimages_store(Request $request)
    {
        // dd($request->all());
        try {
            // Validate request
            $request->validate([
                'news_id' => 'required|exists:news,id',
                'images.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    // Generate unique file name
                    $imageName = time().'_'.uniqid().'.'.$file->extension();

                    // Move the file to public folder
                    $file->move(public_path('upload/images/News_Images'), $imageName);

                    // Store record in NewsImage table
                    NewsImage::create([
                        'news_id' => $request->news_id,
                        'image' => $imageName,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Images uploaded successfully.');

        } catch (\Exception $e) {
            \Log::error('News Images Upload Error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong while uploading images.');
        }
    }

    public function newsimagesstatus($id)
    {
        $news = NewsImage::findOrFail($id);

        // Toggle between 'on' and 'off' (or 'active'/'inactive')
        $news->status = $news->status === 'on' ? 'off' : 'on';
        $news->save();

        return redirect()->back()->with('success', 'News Image status updated successfully');
    }

    public function newsimagesdestroy($id)
    {
        $news = NewsImage::findOrFail($id);

        // Delete image if exists
        if ($news->image && file_exists(public_path('upload/images/News_Images/'.$news->image))) {
            unlink(public_path('upload/images/News_Images/'.$news->image));
        }

        $news->delete();

        return back()->with('success', 'News Image Deleted Successfully');
    }
}
