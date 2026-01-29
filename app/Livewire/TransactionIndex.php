<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TransactionIndex extends Component
{
    public $filterCategory = ''; // Properti untuk filter

    protected $listeners = ['transactionStored' => '$refresh'];

    public function delete($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);
        $transaction->delete();

        // Dispatch browser event untuk notifikasi (opsional)
        $this->dispatch('transactionDeleted');
    }

    public function render()
    {
        $query = Transaction::where('user_id', Auth::id())
            ->with('category');

        // Logika Filter
        if ($this->filterCategory) {
            $query->where('category_id', $this->filterCategory);
        }

        $transactions = $query->latest()->get();

        return view('livewire.transaction-index', [
            'transactions' => $transactions,
            'totalIncome' => $transactions->where('category.type', 'income')->sum('amount'),
            'totalExpense' => $transactions->where('category.type', 'expense')->sum('amount'),
            'categories' => Category::all(),
        ]);
    }
}
