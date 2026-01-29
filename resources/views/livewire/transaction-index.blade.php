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
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-700">Perbandingan Arus Kas</h3>
    <div style="height: 300px;">
        <canvas id="financeChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener('livewire:navigated', () => {
        const ctx = document.getElementById('financeChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    data: [{{ $totalIncome }}, {{ $totalExpense }}],
                    backgroundColor: ['#10B981', '#EF4444'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    });
</script>
