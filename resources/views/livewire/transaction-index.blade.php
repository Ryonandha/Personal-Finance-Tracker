<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 to-blue-700 p-6 rounded-3xl shadow-xl text-white">
            <div class="relative z-10">
                <p class="text-sm font-medium opacity-70 uppercase">Saldo Saat Ini</p>
                <p class="text-3xl font-bold mt-2 text-shadow-sm">Rp {{ number_format($totalIncome - $totalExpense, 0, ',', '.') }}</p>
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-10 text-8xl font-bold italic text-white">💰</div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center space-x-4">
            <div class="p-3 bg-green-50 rounded-2xl text-green-600 text-2xl">📈</div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pemasukan</p>
                <p class="text-xl font-bold text-green-600">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center space-x-4">
            <div class="p-3 bg-red-50 rounded-2xl text-red-600 text-2xl">📉</div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pengeluaran</p>
                <p class="text-xl font-bold text-red-600">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Visualisasi Keuangan</h3>
                <p class="text-sm text-gray-500">Berdasarkan kategori yang dipilih</p>
            </div>

            <select wire:model.live="filterCategory" class="w-full md:w-64 rounded-2xl border-gray-100 bg-gray-50 text-sm focus:ring-indigo-500 focus:border-indigo-500 font-medium py-3">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="relative" style="height: 280px;">
            <canvas id="financeChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50">
            <h3 class="text-lg font-bold text-gray-800">Riwayat Transaksi Terakhir</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-gray-400 text-xs uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Tanggal</th>
                        <th class="px-8 py-4 text-center">Tipe</th>
                        <th class="px-8 py-4">Keterangan</th>
                        <th class="px-8 py-4 text-right">Nominal</th>
                        <th class="px-8 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transactions as $item)
                        <tr class="hover:bg-gray-50/80 transition-all duration-200 group">
                            <td class="px-8 py-5 text-sm text-gray-600 font-medium">
                                {{ \Carbon\Carbon::parse($item->date)->format('d M, Y') }}
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-tighter {{ $item->category->type == 'income' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->category->name }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-sm text-gray-500">{{ $item->description ?? '-' }}</td>
                            <td class="px-8 py-5 text-right font-bold {{ $item->category->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $item->category->type == 'income' ? '+' : '-' }} Rp {{ number_format($item->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-5 text-center">
                                <button wire:click="delete({{ $item->id }})"
                                        wire:confirm="Hapus transaksi ini?"
                                        class="opacity-0 group-hover:opacity-100 p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl mb-4 text-gray-200">📭</span>
                                    <p class="text-gray-400 italic">Belum ada transaksi di kategori ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', () => {
            const ctx = document.getElementById('financeChart');
            if(ctx) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Masuk', 'Keluar'],
                        datasets: [{
                            data: [{{ $totalIncome }}, {{ $totalExpense }}],
                            backgroundColor: ['#10B981', '#EF4444'],
                            borderWidth: 0,
                            hoverOffset: 12,
                            borderRadius: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '80%',
                        plugins: {
                            legend: { display: false }
                        }
                    }
                });
            }
        });
    </script>
</div>
