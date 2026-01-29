<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-blue-500 p-4 rounded-lg shadow text-white">
        <p class="text-sm opacity-80">Total Saldo</p>
        <p class="text-2xl font-bold">Rp {{ number_format($transactions->where('category.type', 'income')->sum('amount') - $transactions->where('category.type', 'expense')->sum('amount'), 0, ',', '.') }}</p>
    </div>
    <div class="bg-green-500 p-4 rounded-lg shadow text-white">
        <p class="text-sm opacity-80">Total Pemasukan</p>
        <p class="text-2xl font-bold">Rp {{ number_format($transactions->where('category.type', 'income')->sum('amount'), 0, ',', '.') }}</p>
    </div>
    <div class="bg-red-500 p-4 rounded-lg shadow text-white">
        <p class="text-sm opacity-80">Total Pengeluaran</p>
        <p class="text-2xl font-bold">Rp {{ number_format($transactions->where('category.type', 'expense')->sum('amount'), 0, ',', '.') }}</p>
    </div>
</div>
