<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium mb-4">Tambah Transaksi Baru</h3>
                @livewire('transaction-create')
            </div>

            <div class="md:col-span-2">
                @livewire('transaction-index')
            </div>
        </div>
    </div>
</div>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Riwayat Transaksi
        </h2>
        @livewire('transaction-index')
    </div>
</div>
