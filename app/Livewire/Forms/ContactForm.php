<?php

namespace App\Livewire\Forms;

use App\Mail\ContactMailer;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    public $name = '';

    public $phone = '';

    public $email = '';

    public $subject = '';

    public $message = '';

    public function rules()
    {
        return [
            'name' => 'required|string"',
            'phone' => 'required',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'required',
        ];
    }
}
