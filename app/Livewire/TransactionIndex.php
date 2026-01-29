<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Category; // Tambahkan ini jika belum ada
use Illuminate\Support\Facades\Auth;

class TransactionIndex extends Component
{
    // 1. TAMBAHKAN PROPERTY INI
    public $filterCategory = '';

    // Listener untuk menangkap sinyal dari TransactionCreate
    protected $listeners = ['transactionStored' => '$refresh'];

    public function render()
    {
        // 2. MODIFIKASI QUERY AGAR BISA FILTER
        $query = Transaction::where('user_id', Auth::id())
            ->with('category');

        if ($this->filterCategory) {
            $query->where('category_id', $this->filterCategory);
        }

        $transactions = $query->latest()->get();

        return view('livewire.transaction-index', [
            'transactions' => $transactions,
            'totalIncome' => $transactions->where('category.type', 'income')->sum('amount'),
            'totalExpense' => $transactions->where('category.type', 'expense')->sum('amount'),
            'categories' => Category::all(), // Kirim data kategori untuk dropdown filter
        ]);
    }

    // Fungsi hapus (sekalian tambahkan jika belum ada)
    public function delete($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);
        $transaction->delete();

        $this->dispatch('transactionStored');
    }
}
