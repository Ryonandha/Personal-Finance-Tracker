<?php

namespace App\Livewire;

use Livewire\Component;

class TransactionCreate extends Component
{
    public function render()
    {
        return view('livewire.transaction-create');
    }
    public function save()
{
    $this->validate([
        'amount' => 'required|numeric',
        'category_id' => 'required',
        'date' => 'required|date',
        'description' => 'nullable|string',
    ]);

    \App\Models\Transaction::create([
        'user_id' => auth()->id(),
        'category_id' => $this->category_id,
        'amount' => $this->amount,
        'date' => $this->date,
        'description' => $this->description,
    ]);
$this->dispatch('transactionStored'); // Kirim sinyal
$this->reset(['amount', 'category_id', 'description', 'date']); // Kosongkan form
    return redirect()->to('/dashboard'); // Refresh ke dashboard
}
}
