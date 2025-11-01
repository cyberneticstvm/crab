<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Country;
use App\Models\CustomMessage;
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
                        $res = sendWAMessage($url, $member, 'crab_notification', 'Message_From_CRAB_House_TVM_');
                    endif;
                endforeach;
            else:
                return redirect()->back()->with("error", "Inavlid file path")->withInput($request->all());
            endif;
            //File::delete(public_path('pdfs/' . $filename));
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->back()->with("success", "Message sent successfully");
    }

    function sendWAReceipt(string $id)
    {
        try {
            $donation = Contribution::findOrFail(decrypt($id));
            $filename = 'crab_house_receipt_' . time() . '.pdf';
            $path = public_path('pdfs/');
            $pdf = Pdf::loadview('pdfs.contribution-receipt', compact('donation'));
            $pdf->save($path . $filename);
            $url = 'https://crab.softbugs.in/public/pdfs/' . $filename;
            if (File::exists(public_path('pdfs/' . $filename))):
                $member = Member::find($donation->member_id);
                if ($member):
                    $res = sendWAMessage($url, $member, 'crab_send_donation_receipt', 'Donation_Receipt_From_CRAB_House_TVM_');
                endif;
            else:
                return redirect()->back()->with("error", "Inavlid file path");
            endif;
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "Receipt sent successfully");
    }

    function customMessages()
    {
        $messages = CustomMessage::latest()->get();
        return view("message.custom.index", compact('messages', 'pcodes'));
    }

    function saveCustomMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_code' => 'required',
            'mobile' => 'required|numeric',
        ]);

        try {
            $message = Message::findOrFail($request->mid);
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
                $member = (object)[
                    'phone_code' => $request->phone_code,
                    'mobile' => $request->mobile,
                    'name' => $request->name,
                ];
                $res = sendWAMessage($url, $member, 'crab_notification', 'Message_From_CRAB_House_TVM_');
                dd($res);
                die;
            else:
                return redirect()->back()->with("error", "Inavlid file path")->withInput($request->all());
            endif;
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "Message sent successfully");
    }
}
