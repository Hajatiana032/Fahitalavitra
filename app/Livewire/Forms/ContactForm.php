<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class ContactForm extends Form
{
    public $name = '';

    public $phone = '';

    public $email = '';

    public $subject = '';

    public $message = '';

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string"',
            'phone' => 'required|phone:MG',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'required',
        ];
    }
}
