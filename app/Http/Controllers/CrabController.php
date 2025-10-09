<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Message;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CrabController extends Controller
{
    function dashboard()
    {
        return view('dashboard');
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with("success", "User logged out successfully");
    }

    function waMessage(string $id)
    {
        $members = Member::orderBy('name')->get();
        $message = Message::findOrFail(decrypt($id));
        return view('message.message', compact('members', 'message'));
    }

    function sendWAMessage(Request $request, string $id)
    {
        $request->validate([
            'recipients' => 'required',
        ]);
        $message = Message::findOrFail(decrypt($id));
        /*foreach ($request->recipients as $key => $recipient):
            $member = Member::find($recipient);
            if ($member):
                $pdf = PDF::loadview('', compact('message'));
                $file = $pdf->output();
            endif;
        endforeach;*/
        $filename = 'message_' . time() . '.pdf';
        $path = 'pdfs/' . $filename;
        $pdf = Pdf::loadview('pdfs.wa-message', compact('message'));
        Storage::put($path, $pdf->output());
        echo 'https://crab.softbugs.in/storage' . $path;
        /*$res = sendWAMessage($file);
        dd($res);
        die;*/
    }
}
