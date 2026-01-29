<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-500 p-4 rounded-lg shadow text-white">
            <p class="text-sm opacity-80">Total Saldo</p>
            <p class="text-2xl font-bold">Rp {{ number_format($totalIncome - $totalExpense, 0, ',', '.') }}</p>
        </div>
        <div class="bg-green-500 p-4 rounded-lg shadow text-white">
            <p class="text-sm opacity-80">Total Pemasukan</p>
            <p class="text-2xl font-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
        </div>
        <div class="bg-red-500 p-4 rounded-lg shadow text-white">
            <p class="text-sm opacity-80">Total Pengeluaran</p>
            <p class="text-2xl font-bold">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Perbandingan Arus Kas</h3>
        <div style="height: 300px;">
            <canvas id="financeChart"></canvas>
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <<div class="mb-4">
    <select wire:model.live="filterCategory" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Semua Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Keterangan</th>
                    <th class="px-6 py-3">Jumlah</th>
                    <th class="px-6 py-3">Aksi</th>
                    <td class="px-6 py-4">
    <button wire:click="delete({{ $transaction->id }})"
            wire:confirm="Apakah Anda yakin ingin menghapus transaksi ini?"
            class="text-red-600 hover:text-red-900">
        Hapus
    </button>
</td>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{ $transaction->date }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs {{ $transaction->category->type == 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $transaction->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $transaction->description }}</td>
                        <td class="px-6 py-4 font-bold {{ $transaction->category->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('livewire:navigated', () => {
            const ctx = document.getElementById('financeChart');
            if(ctx) {
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
            }
        });
    </script>
</div>
