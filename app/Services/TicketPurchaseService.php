<?php

namespace App\Services;

use App\Models\Projection;
use App\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class TicketPurchaseService
{
    /**
     * Buy one or many tickets for one projection
     * @param  Projection  $projection
     * @param  string  $fullname
     * @param  string  $phone
     * @param  string  $email
     * @param  int  $quantity
     * @return array
     * @throws Throwable
     */
    public function purchase(
        Projection $projection,
        string $fullname,
        string $phone,
        string $email,
        int $quantity = 1
    ): array {
        if ($quantity < 1) {
            throw new Exception("La quantité doit être au moins 1.");
        }

        if ($projection->isPast()) {
            throw new Exception("Impossible d'acheter des billets pour une projection passée.");
        }

        if ( ! $projection->hasAvailableSeats($quantity)) {
            $available = $projection->getAvailableSeats();
            throw new Exception(
                "Pas assez de places disponibles. Il reste {$available} place(s)."
            );
        }

        return DB::transaction(function () use ($projection, $fullname, $phone, $email, $quantity) {
            $tickets = [];

            for ($i = 0; $i < $quantity; $i++) {
                $ticket = Ticket::create([
                    'projection_id' => $projection->id,
                    'fullname' => $fullname,
                    'phone' => $phone,
                    'email' => $email,
                    'price' => $projection->price,
                    'status' => 'valid',
                ]);

                $tickets[] = $ticket;
            }

            return $tickets;
        });
    }

    /**
     * Cancel a ticket
     *
     * @param  Ticket  $ticket
     * @return bool
     * @throws Exception
     */
    public function cancel(Ticket $ticket): bool
    {
        if ($ticket->status === 'used') {
            throw new Exception("Impossible d'annuler un billet déjà utilisé.");
        }

        if ($ticket->projection->isPast()) {
            throw new Exception("Impossible d'annuler un billet pour une projection passée.");
        }

        return $ticket->update(['status' => 'cancelled']);
    }

    /**
     * Valider un billet (scanner à l'entrée)
     *
     * @param  string  $code
     * @return Ticket
     * @throws Exception
     */
    public function validate(string $code): Ticket
    {
        $ticket = Ticket::where('code', $code)->firstOrFail();

        if ($ticket->status === 'used') {
            throw new Exception("Ce billet a déjà été utilisé.");
        }

        if ($ticket->status === 'cancelled') {
            throw new Exception("Ce billet a été annulé.");
        }

        $ticket->markAsUsed();

        return $ticket;
    }
}
