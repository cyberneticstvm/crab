<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        $messages = Message::withTrashed()->where('type', $type)->latest()->get();
        $pcodes = Country::pluck('phone', 'phone');
        return view(($type == 'regular') ? 'message.index' : 'message.custom.index', compact('messages', 'pcodes', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $type)
    {
        return view('message.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $type)
    {
        $request->validate([
            //'title' => 'required|unique:messages,title',
            'message' => 'required|min:10|max:1500',
        ]);
        try {
            $inputs = $request->all();
            $inputs['type'] = $type;
            $inputs['is_signed'] = ($request->is_signed) ?? null;
            $inputs['created_by'] = Auth::user()->id;
            $inputs['updated_by'] = Auth::user()->id;
            Message::create($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('message.register', $type)->with("success", "Message recorded successfully");
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
        $message = Message::findOrFail(decrypt($id));
        return view('message.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $type)
    {
        $request->validate([
            //'title' => 'required|unique:messages,title,' . decrypt($id),
            'message' => 'required|min:10|max:1500',
        ]);
        try {
            $message = Message::findOrFail(decrypt($id));
            $inputs = $request->all();
            $inputs['is_signed'] = ($request->is_signed) ?? null;
            $inputs['updated_by'] = Auth::user()->id;
            $message->update($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('message.register', $type)->with("success", "Message updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $type)
    {
        Message::findOrFail(decrypt($id))->delete();
        return redirect()->route('message.register', $type)->with("success", "Message deleted successfully");
    }
}
