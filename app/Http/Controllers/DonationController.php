<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\PaymentMode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::withTrashed()->orderBy('donation_date')->get();
        return view('donation.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pmodes = PaymentMode::pluck('name', 'id');
        return view('donation.create', compact('pmodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'donation_date' => 'required|date',
            'name' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
            'payment_mode' => 'required',
            'amount' => 'required|numeric|gt:0',
        ]);
        try {
            $inputs = $request->all();
            $inputs['created_by'] = Auth::user()->id;
            $inputs['updated_by'] = Auth::user()->id;
            Donation::create($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('donation.register')->with("success", "Donation recorded successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $donation = Donation::findOrFail(decrypt($id));
        $pmodes = PaymentMode::pluck('name', 'id');
        return view('donation.edit', compact('donation', 'pmodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'donation_date' => 'required|date',
            'name' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
            'payment_mode' => 'required',
            'amount' => 'required|numeric|gt:0',
        ]);
        try {
            $donation = Donation::findOrFail(decrypt($id));
            $inputs = $request->all();
            $inputs['updated_by'] = Auth::user()->id;
            $donation->update($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('donation.register')->with("success", "Donation updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Donation::findOrFail(decrypt($id))->delete();
        return redirect()->route('donation.register')->with("success", "Donation deleted successfully");
    }
}
