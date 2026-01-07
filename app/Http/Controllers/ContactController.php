<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Mail\ContactMailer;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(SendEmailRequest $request)
    {
        Mail::to($request->email)->send(new ContactMailer($request->validated()));

        return back()->with('success', 'Message envoyé!');
    }
}
