<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Message;
use Barryvdh\DomPDF\Facade\Pdf;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as mpdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CrabController extends Controller
{
    function dashboard()
    {
        $members = Member::withTrashed()->orderBy('name')->get();
        return view('dashboard', compact('members'));
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

    function waMessagePreview(string $id)
    {
        $message = Message::findOrFail(decrypt($id));
        if ($message->letter_head == 1):
            $pdf = mpdf::loadview('pdfs.wa-message', compact('message'));
        else:
            $pdf = mpdf::loadview('pdfs.wa-message1', compact('message'));
        endif;
        return $pdf->stream('message' . '.pdf');
    }

    function sendWAMessage(Request $request, string $id)
    {
        $request->validate([
            'recipients' => 'required',
        ]);
        try {
            $message = Message::findOrFail(decrypt($id));
            $filename = 'crab_house_' . time() . '.pdf';
            $path = public_path('pdfs/');
            if ($message->letter_head == 1):
                $pdf = mpdf::loadview('pdfs.wa-message', compact('message'));
            else:
                $pdf = mpdf::loadview('pdfs.wa-message1', compact('message'));
            endif;
            $pdf->save($path . $filename);
            $url = 'https://crab.softbugs.in/public/pdfs/' . $filename;
            if (File::exists(public_path('pdfs/' . $filename))):
                foreach ($request->recipients as $key => $recipient):
                    $member = Member::find($recipient);
                    if ($member):
                        $res = sendWAMessage($url, $member);
                    endif;
                endforeach;
                File::delete(public_path('pdfs/' . $filename));
            else:
                return redirect()->back()->with("error", "Inavlid file path")->withInput($request->all());
            endif;
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->back()->with("success", "Message sent successfully");
    }
}
