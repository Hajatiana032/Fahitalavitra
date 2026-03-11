<?php

use App\Models\Projection;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Stripe\StripeClient;

new class extends Component {
    public int $id;

    public string $title;

    #[Validate('nullable|string')]
    public string $lastname = '';

    #[Validate('required|string')]
    public string $firstname = '';

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|phone:MG')]
    public string $phone = '';

    #[Validate('required|integer|min:1')]
    public int $quantity = 1;

    /**
     * @return void
     */
    public function buy()
    {
        $this->validate();
        $projection = Projection::query()->find($this->id);
        $stripe = new StripeClient(config('services.stripe_api_secret_key'));

        $checkout_session = $stripe->checkout->sessions->create([
            'customer_email' => $this->email,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'mga',
                        'product_data' => [
                            'name' => $this->title,
                        ],
                        'unit_amount' => $projection->price,
                    ],
                    'quantity' => $this->quantity,
                ],
            ],
            'metadata' => [
                'projection_id' => $this->id,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'phone' => $this->phone,
                'quantity' => $this->quantity,
            ],
            'mode' => 'payment',
            'ui_mode' => 'embedded',
            'return_url' => route('status'),
        ]);
        session(['client_secret' => $checkout_session->client_secret, 'session_id' => $checkout_session->id]);
        $this->redirect(route('checkout'), true);
    }

    /**
     * @return void
     */
    public function increment(): void
    {
        $this->quantity++;
    }

    /**
     * @return void
     */
    public function decrement(): void
    {
        $this->quantity--;
    }
};
