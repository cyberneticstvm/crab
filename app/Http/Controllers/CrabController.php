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
        $message = Message::findOrFail(decrypt($id));
        $pdf = Pdf::loadview('pdfs.wa-message', compact('message'));
        //return $pdf->stream('message' . '.pdf');
        /*return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'message' . '.pdf');*/
        //try {
        $message = Message::findOrFail(decrypt($id));
        $filename = 'message_' . time() . '.pdf';
        $path = 'pdfs/' . $filename;
        $path1 = 'pdf/' . $filename;
        $pdf = Pdf::loadview('pdfs.wa-message', compact('message'));
        Storage::put($path, $pdf->output());
        $url = 'https://crab.softbugs.in/public/storage/' . $path;
        if (Storage::disk('public')->exists($path1)):
            foreach ($request->recipients as $key => $recipient):
                $member = Member::find($recipient);
                if ($member):
                    $res = sendWAMessage($url, $member);
                endif;
            endforeach;
        else:
            return redirect()->back()->with("error", "Inavlid file path")->withInput($request->all());
        endif;
        //} catch (Exception $e) {
        //return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        //}
        return redirect()->back()->with("success", "Message sent successfully");
    }
}
