<div>
    {{-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh --}}
    <div class="flex flex-col items-center justify-center py-20">

        @if ($status === 'complete')
            <div class="text-center">
                <div class="text-6xl mb-4"><i class="far fa-check-circle"></i></div>
                <h1 class="text-3xl font-bold mb-2">Merci pour votre paiement !</h1>
                <p class="text-gray-500">
                    Les billets ont été envoyés à l'adresse suivant:
                    <span class="font-semibold">{{ $customerEmail }}</span>
                </p>
                <button href="{{ route('home') }}"
                        class="btn btn-primary mt-6 waves"
                        wire:navigate>
                    Retour à l'accueil
                </button>
            </div>

        @elseif ($status === 'open')
            <div class="text-center">
                <div class="text-6xl mb-4">⚠️</div>
                <h1 class="text-3xl font-bold mb-2">Paiement incomplet</h1>
                <p class="text-gray-500">Votre paiement n'a pas été finalisé.</p>
                <button href="{{ route('checkout') }}"
                        class="btn btn-warning mt-6 waves"
                        wire:navigate>
                    Réessayer
                </button>
            </div>

        @else
            <div class="text-center">
                <div class="text-6xl mb-4">❌</div>
                <h1 class="text-3xl font-bold mb-2">Une erreur est survenue</h1>
                <button href="{{ route('checkout') }}"
                        class="btn btn-error mt-6 waves"
                        wire:navigate>
                    Réessayer
                </button>
            </div>
        @endif

    </div>
</div>
