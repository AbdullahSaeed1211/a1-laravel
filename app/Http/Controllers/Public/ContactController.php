<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\SEOService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('contact', $lang);

        return view('public.contact', compact('meta', 'lang'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:5000',
        ]);

        try {
            $phone = $validated['phone'] ?? 'N/A';
            $body = "Name: {$validated['name']}\nEmail: {$validated['email']}\nPhone: {$phone}\n\nMessage:\n{$validated['message']}";
            Mail::raw($body, function ($mail) use ($validated) {
                $mail->to(env('MAIL_FROM_ADDRESS', 'info@a1traininggroupllc.com'))
                    ->subject('A1 Training Contact: '.$validated['name'])
                    ->replyTo($validated['email']);
            });

            return redirect()->back()->with('success', 'Thank you for your message. We will get back to you shortly.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sorry, there was an issue sending your message. Please try again.');
        }
    }
}
