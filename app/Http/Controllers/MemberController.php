<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        $members = Member::withTrashed()->where('type', $type)->orderBy('name')->get();
        return view('member.index', compact('members', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        return view('member.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $type)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric|digits:10|unique:members,mobile',
            'email' => 'nullable|unique:members,email',
            'address' => 'required',
        ]);
        try {
            $inputs = $request->all();
            $inputs['type'] = $type;
            $inputs['created_by'] = Auth::user()->id;
            $inputs['updated_by'] = Auth::user()->id;
            Member::create($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('member.register', $type)->with("success", "Member created successfully");
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
        $member = Member::findOrFail(decrypt($id));
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric|digits:10|unique:members,mobile,' . decrypt($id),
            'email' => 'nullable|unique:members,email,' . decrypt($id),
            'address' => 'required',
        ]);
        try {
            $member = Member::findOrFail(decrypt($id));
            $inputs = $request->all();
            $inputs['updated_by'] = Auth::user()->id;
            $member->update($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('member.register', $member->type)->with("success", "Member updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::findOrFail(decrypt($id));
        $member->delete();
        return redirect()->route('member.register', $member->type)->with("success", "Member deleted successfully");
    }
}
