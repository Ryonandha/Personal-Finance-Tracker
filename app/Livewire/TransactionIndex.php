<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionIndex extends Component
{
    public function render()
{
    $transactions = Transaction::where('user_id', auth()->id())
        ->with('category')
        ->latest()
        ->get();

    return view('livewire.transaction-index', [
        'transactions' => $transactions,
        'totalIncome' => $transactions->where('category.type', 'income')->sum('amount'),
        'totalExpense' => $transactions->where('category.type', 'expense')->sum('amount'),
    ]);
}
    protected $listeners = ['transactionStored' => '$refresh'];
}
