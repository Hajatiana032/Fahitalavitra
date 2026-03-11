<?php

use Livewire\Component;
use App\Livewire\Forms\ContactForm;
use App\Mail\ContactMailer;

new class extends Component {
    public ContactForm $form;

    public function send()
    {
        $this->form->validate();
        Mail::send(new ContactMailer($this->form->all()));
        $this->form->reset();
    }
};
?>

<div>
    <form wire:submit='send'
          class="max-w-80 m-auto">
        <div class="mb-2">
            <label for="name">Nom et prénom</label>
            <input type="text"
                   class="input pin-input @error('form.name') is-invalid @enderror"
                   id="name"
                   wire:model='form.name'>
            @error('form.name')
            <div class="text-error mb-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="phone">Numéro de téléphone</label>
            <input type="tel"
                   class="input pin-input @error('form.phone') is-invalid @enderror"
                   id="phone"
                   wire:model='form.phone'>
            @error('form.phone')
            <div class="text-error mb-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="email">Adresse e-mail</label>
            <input type="email"
                   class="input pin-input @error('form.email') is-invalid @enderror"
                   id="email"
                   wire:model='form.email'>
            @error('form.email')
            <div class="text-error mb-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="subject">Sujet</label>
            <input type="text"
                   class="input pin-input @error('form.subject') is-invalid @enderror"
                   id="subject"
                   wire:model='form.subject'>
            @error('form.subject')
            <div class="text-error mb-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="message">Message</label>
            <textarea name=""
                      id="message"
                      cols="30"
                      rows="10"
                      class="textarea resize-none @error('form.message') is-invalid @enderror"
                      wire:model='form.message'></textarea>
            @error('form.message')
            <div class="text-error mb-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="text-end">
            <button type="submit"
                    class="btn btn-primary waves">
                Envoyer
                <i class="far fa-paper-plane"></i>
            </button>
        </div>
    </form>
</div>
