<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionIndex extends Component
{
    public function render()
    {
        return view('livewire.transaction-index', [
            // Mengambil transaksi terbaru dari user yang login
            'transactions' => Transaction::where('user_id', Auth::id())
                ->with('category') // Eager loading agar tidak berat
                ->latest()
                ->get()
        ]);
    }
}
