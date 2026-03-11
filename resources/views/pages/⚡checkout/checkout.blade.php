<div>
    <h1 class="text-4xl font-bold mb-8">Finalisation de votre achat</h1>
    @if(session('client_secret'))
        <div id="checkout"></div>
    @else
        <div class="text-center text-3xl alert alert-error alert-soft">Une erreur est survenue</div>
    @endif

    @push('scripts')
        <script>
            // Initialize Stripe.js
            const stripe = Stripe('pk_test_oKhSR5nslBRnBZpjO6KuzZeX');


            // Fetch Checkout Session and retrieve the client secret
            (async () => {
                const checkout = await stripe.initEmbeddedCheckout({
                    clientSecret: '{{ session('client_secret')
                        }}'
                });

                // Mount Checkout
                checkout.mount('#checkout');
            })();
        </script>
    @endpush
</div>
