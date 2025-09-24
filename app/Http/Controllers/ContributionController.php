<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\Member;
use App\Models\PaymentMode;
use Exception;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{
    public function index()
    {
        $donations = Contribution::withTrashed()->orderBy('payment_date')->get();
        return view('contribution.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pmodes = PaymentMode::pluck('name', 'id');
        $members = Member::pluck('name', 'id');
        return view('contribution.create', compact('pmodes', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_date' => 'required|date',
            'member_id' => 'required',
            'payment_mode' => 'required',
            'amount' => 'required|numeric|gt:0',
        ]);
        try {
            $inputs = $request->all();
            $inputs['created_by'] = Auth::user()->id;
            $inputs['updated_by'] = Auth::user()->id;
            Contribution::create($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('contribution.register')->with("success", "Contribution recorded successfully");
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
        $donation = Contribution::findOrFail(decrypt($id));
        $pmodes = PaymentMode::pluck('name', 'id');
        $members = Member::pluck('name', 'id');
        return view('contribution.edit', compact('donation', 'pmodes', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'payment_date' => 'required|date',
            'member_id' => 'required',
            'payment_mode' => 'required',
            'amount' => 'required|numeric|gt:0',
        ]);
        try {
            $donation = Contribution::findOrFail(decrypt($id));
            $inputs = $request->all();
            $inputs['updated_by'] = Auth::user()->id;
            $donation->update($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('contribution.register')->with("success", "Contribution updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Contribution::findOrFail(decrypt($id))->delete();
        return redirect()->route('contribution.register')->with("success", "Contribution deleted successfully");
    }
}
