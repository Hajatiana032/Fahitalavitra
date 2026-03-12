<?php

use App\Models\Customer;
use App\Models\Projection;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\SentMessage;
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
            $customer = $this->createCustomer($session);
            $tickets = $this->createTickets($customer, $session->metadata->quantity);
            $projection = Projection::find($session->metadata->projection_id);
            $this->sendTickets($customer, $tickets, $projection, $session);

            session()->flush();
        }
        $this->customerEmail = $session->customer_details->email ?? '';
    }

    /**
     * @param  string|int  $session
     * @return mixed
     */
    public function createCustomer($session): Customer
    {
        return Customer::create([
            'first_name' => $session->metadata->firstname,
            'last_name' => $session->metadata->lastname,
            'phone' => $session->metadata->phone,
            'projection_id' => $session->metadata->projection_id,
            'email' => $session->customer_email,
        ]);
    }

    /**
     * @param  Customer  $customer
     * @param  int  $quantity
     * @return array
     */
    public function createTickets(Customer $customer, int $quantity): array
    {
        $tickets = [];

        for ($i = 0; $i < $quantity; $i++) {
            $tickets[] = Ticket::create([
                'customer_id' => $customer->id,
            ]);
        }

        return $tickets;
    }


    /**
     * @param $customer
     * @param $tickets
     * @param $projection
     * @param $session
     * @return SentMessage|mixed|null
     */
    public function sendTickets($customer, $tickets, $projection, $session): mixed
    {
        return \Illuminate\Support\Facades\Mail::send(
            'mail.tickets',
            ['customer' => $customer, 'projection' => $projection, 'quantity' => $session->metadata->quantity],
            function ($message) use ($customer, $tickets, $projection) {
                $message->to($customer->email)
                    ->subject('Votre billet');
                foreach ($tickets as $ticket) {
                    $pdf = Pdf::loadView('tickets.pdf', [
                        'customer' => $customer,
                        'ticket' => $ticket,
                        'projection' => $projection,
                    ]);
                    $message->attachData($pdf->output(), 'ticket.pdf');
                }
            }
        );
    }
};
