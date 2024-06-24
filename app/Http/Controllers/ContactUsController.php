<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Contracts\Interfaces\BackgroundInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsMailer;
use App\Services\ContactService;
use DerekCodes\TurnstileLaravel\TurnstileLaravel;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    private BackgroundInterface $background;
    private ProfileInterface $profile;
    private ContactService $service;

    public function __construct(BackgroundInterface $background, ProfileInterface $profileData, ContactService $service)
    {
        $this->profile = $profileData;
        $this->background = $background;
        $this->service = $service;
    }
    /**
     * Handle the view of contact-us
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(): View
    {
        $background = $this->background->getByType('Hubungi Kami');

        return view('landing.contact', compact('background'));
    }

    /**
     * Handle the form submission
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactUsRequest $request)
    {
        # Verify the Turnstile
        // $turnstile = new TurnstileLaravel;
        // $turnstile->validate($request->input('cf-turnstile-response'));

        # Get company profile data
        $profile = $this->profile->first();

        # Check if profile data is exists on database
        if ($profile === null) {
            return back()->with('gagal','Ada beberapa kesalahan!');
        }

        try {
            $this->service->SendMail($request, 'ardiansupriadi464@gmail.com');
            return back()->with('berhasil','Pesan anda sudah terkirim!');
        } catch (\Exception $e) {
            return back()->with('gagal','Ada beberapa kesalahan!'.$e->getMessage());
        }
    }
}
