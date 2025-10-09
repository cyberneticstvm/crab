<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Message;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
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
        try {
            $message = Message::findOrFail(decrypt($id));
            $filename = 'message_' . time() . '.pdf';
            $path = 'pdfs/' . $filename;
            $pdf = Pdf::loadview('pdfs.wa-message', compact('message'));
            $url = 'https://crab.softbugs.in/public/storage/' . $path;
            Storage::put($path, $pdf->output());
            foreach ($request->recipients as $key => $recipient):
                $member = Member::find($recipient);
                if ($member):
                    sendWAMessage($url, $member);
                endif;
            endforeach;
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->back()->with("success", "Message sent successfully");
    }
}
