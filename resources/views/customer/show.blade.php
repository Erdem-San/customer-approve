<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Müşteri Bilgileri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Müşteri Bilgileri</h1>
                    <p class="text-lg"><strong>Ad:</strong> {{ $customer->ad }}</p>
                    <p class="text-lg"><strong>Soyad:</strong> {{ $customer->soyad }}</p>
                    <p class="text-lg"><strong>Ev No:</strong> {{ $customer->ev_no }}</p>
                    <p class="text-lg"><strong>Posta Kodu:</strong> {{ $customer->posta_kodu }}</p>
                    <p class="text-lg"><strong>Sehir:</strong> {{ $customer->sehir }}</p>
                    <p class="text-lg"><strong>Mail:</strong> {{ $customer->mail }}</p>
                    <p class="text-lg mb-6"><strong>Tel No:</strong> {{ $customer->tel_no }}</p>

                    <form action="{{ route('customer.approve', $customer->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="{{ $customer->id }}">
                        <input type="hidden" name="ad" value="{{ $customer->ad }}">
                        <input type="hidden" name="soyad" value="{{ $customer->soyad }}">
                        <input type="hidden" name="ev_no" value="{{ $customer->ev_no }}">
                        <input type="hidden" name="posta_kodu" value="{{ $customer->posta_kodu }}">
                        <input type="hidden" name="sehir" value="{{ $customer->sehir }}">
                        <input type="hidden" name="mail" value="{{ $customer->mail }}">
                        <input type="hidden" name="tel_no" value="{{ $customer->tel_no }}">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-full rounded">
                            Onaylıyorum
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
