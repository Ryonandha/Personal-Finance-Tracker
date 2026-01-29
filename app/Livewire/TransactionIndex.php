<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionIndex extends Component
{
    public function render()
{

    $query = Transaction::where('user_id', auth()->id())->with('category');

    if ($this->filterCategory) {
        $query->where('category_id', $this->filterCategory);
    }
    $transactions = $query->latest()->get();
    return view('livewire.transaction-index', [
        'transactions' => $transactions,
        'totalIncome' => $transactions->where('category.type', 'income')->sum('amount'),
        'totalExpense' => $transactions->where('category.type', 'expense')->sum('amount'),
    ]);
}
public function delete($id)
{
    $transaction = Transaction::where('user_id', auth()->id())->findOrFail($id);
    $transaction->delete();

    // Refresh grafik dan data
    $this->dispatch('transactionStored');
}
    protected $listeners = ['transactionStored' => '$refresh'];
}
