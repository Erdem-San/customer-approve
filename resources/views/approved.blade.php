<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Onaylanmış Müşteri Listesi</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b">Ad</th>
                                    <th class="py-2 px-4 border-b">Soyad</th>
                                    <th class="py-2 px-4 border-b">Ev No</th>
                                    <th class="py-2 px-4 border-b">Posta</th>
                                    <th class="py-2 px-4 border-b">Şehir</th>
                                    <th class="py-2 px-4 border-b">Mail</th>
                                    <th class="py-2 px-4 border-b">Tel No</th>
                                    <th class="py-2 px-4 border-b">Onaylanma Tarihi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $customer->ad }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->soyad }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->ev_no }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->posta_kodu }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->sehir }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->mail }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->tel_no }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination links -->
                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
