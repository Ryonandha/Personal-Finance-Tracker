<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Finance Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-4 space-y-4">
                    <div class="sticky top-6">
                        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                            <div class="flex items-center space-x-3 mb-6">
                                <span class="bg-indigo-100 p-2 rounded-lg text-indigo-600 text-lg">✍️</span>
                                <h3 class="text-lg font-bold text-gray-800">Tambah Transaksi</h3>
                            </div>

                            @livewire('transaction-create')
                        </div>

                        <div class="mt-4 bg-indigo-50 p-6 rounded-3xl border border-indigo-100">
                            <p class="text-sm text-indigo-700 font-medium">
                                💡 <strong>Tips:</strong> Rutin mencatat pengeluaran membantu Anda mengontrol finansial lebih baik!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-6">

                    @livewire('transaction-index')

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
