<?php

namespace Modules\Advertisement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Advertisement\Entities\Advertisemment;
use Modules\Advertisement\Entities\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::latest()->get();

        return view('advertisement::clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('hello');

        return view('advertisement::clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // VALIDATION
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'alternate_phone' => 'nullable|string',
            'address' => 'nullable|string',

            'company_name' => 'nullable|string',
            'company_email' => 'nullable|email',
            'company_phone' => 'nullable|string',
            'company_pan' => 'nullable|string',
            'company_address' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp',

            'owner_name' => 'nullable|string',
            'owner_email' => 'nullable|email',
            'owner_phone' => 'nullable|string',
            'owner_image' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp',
            'owner_address' => 'nullable|string',

            'status' => 'nullable',
        ]);

        $data = $request->except(['company_logo', 'owner_image']);

        if ($request->company_logo) {
            $logoName = time().'_company.'.$request->company_logo->extension();
            $request->company_logo->move(public_path('upload/images/company'), $logoName);

            $data['company_logo'] = $logoName;
        }

        if ($request->owner_image) {
            $ownerImg = time().'_owner.'.$request->owner_image->extension();
            $request->owner_image->move(public_path('upload/images/owner'), $ownerImg);

            $data['owner_image'] = $ownerImg;
        }
        $data['status'] = $request->status ? 'on' : 'off';

        Client::create($data);

        return redirect()->route('clients.index')->with('success', 'Client Created Successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        $today = Carbon::today();

        // Running ads (not expired yet)
        $runningAds = Advertisemment::where('client_id', $id)
            ->whereDate('expire_date', '>=', $today)
            ->get();

        // Past ads (already expired)
        $pastAds = Advertisemment::where('client_id', $id)
            ->whereDate('expire_date', '<', $today)
            ->get();

        return view('advertisement::clients.details', compact('client', 'runningAds', 'pastAds'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('advertisement::clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        // VALIDATION
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'alternate_phone' => 'nullable|string',
            'address' => 'nullable|string',

            'company_name' => 'nullable|string',
            'company_email' => 'nullable|email',
            'company_phone' => 'nullable|string',
            'company_pan' => 'nullable|string',
            'company_address' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp',

            'owner_name' => 'nullable|string',
            'owner_email' => 'nullable|email',
            'owner_phone' => 'nullable|string',
            'owner_image' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp',
            'owner_address' => 'nullable|string',

            'status' => 'nullable',
        ]);

        // Get all form inputs except file fields
        $data = $request->except(['company_logo', 'owner_image']);

        /* ============================
            COMPANY LOGO UPDATE
        ============================= */
        if ($request->company_logo) {

            // Delete old logo
            if ($client->company_logo && file_exists(public_path('upload/images/company/'.$client->company_logo))) {
                unlink(public_path('upload/images/company/'.$client->company_logo));
            }

            // Upload new logo
            $logoName = time().'_company.'.$request->company_logo->extension();
            $request->company_logo->move(public_path('upload/images/company'), $logoName);

            $data['company_logo'] = $logoName;
        }

        /* ============================
            OWNER IMAGE UPDATE
        ============================= */
        if ($request->owner_image) {

            // Delete old owner image
            if ($client->owner_image && file_exists(public_path('upload/images/owner/'.$client->owner_image))) {
                unlink(public_path('upload/images/owner/'.$client->owner_image));
            }

            // Upload new owner image
            $ownerImg = time().'_owner.'.$request->owner_image->extension();
            $request->owner_image->move(public_path('upload/images/owner'), $ownerImg);

            $data['owner_image'] = $ownerImg;
        }

        /* ============================
            UPDATE STATUS
        ============================= */
        $data['status'] = $request->status ? 'on' : 'off';

        /* ============================
            SAVE UPDATE
        ============================= */
        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Client Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client Deleted Successfully');
    }

    public function status($id)
    {
        $client = Client::findOrFail($id);

        $client->status = $client->status === 'on' ? 'off' : 'on';
        $client->save();

        return redirect()->back()->with('success', 'Client status updated successfully');
    }
}
