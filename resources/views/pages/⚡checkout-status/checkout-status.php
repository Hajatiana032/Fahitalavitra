<?php

use App\Models\Customer;
use App\Models\Ticket;
use Livewire\Component;
use Stripe\Stripe;

new class extends Component {
    public string $status = '';
    public string $customerEmail = '';

    public function mount()
    {
        if ( ! session('session_id')) {
            $this->status = 'error';

            return;
        }
        Stripe::setApiKey(config('services.stripe_api_secret_key'));
        $session = \Stripe\Checkout\Session::retrieve(session('session_id'));
        $this->status = $session->status;
        if ($this->status == 'complete') {
            $customer = Customer::create([
                'first_name' => $session->metadata->firstname,
                'last_name' => $session->metadata->lastname,
                'phone' => $session->metadata->phone,
                'projection_id' => $session->metadata->projection_id,
                'email' => $session->customer_email,
            ]);

            Ticket::create(['customer_id' => $customer->id]);
            session()->flush();
        }
        $this->customerEmail = $session->customer_details->email ?? '';
    }
};
