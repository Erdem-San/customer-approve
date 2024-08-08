<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Klant Informatie') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Klant Informatie</h1>
                    <p class="text-lg"><strong>Geslacht:</strong> {{ $customer->geslacht }}</p>
                    <p class="text-lg"><strong>Voornaam:</strong> {{ $customer->voornaam }}</p>
                    <p class="text-lg"><strong>Tussenvoegsel:</strong> {{ $customer->tussenvoegsel }}</p>
                    <p class="text-lg"><strong>Achternaam:</strong> {{ $customer->achternaam }}</p>
                    <p class="text-lg"><strong>Straatnaam:</strong> {{ $customer->straatnaam }}</p>
                    <p class="text-lg"><strong>Huisnummer:</strong> {{ $customer->huisnummer }}</p>
                    <p class="text-lg"><strong>Toevoeging:</strong> {{ $customer->toevoeging }}</p>
                    <p class="text-lg"><strong>Postcode:</strong> {{ $customer->postcode }}</p>
                    <p class="text-lg"><strong>Woonplaats:</strong> {{ $customer->woonplaats }}</p>
                    <p class="text-lg"><strong>Geboortedatum:</strong> {{ $customer->geboortedatum }}</p>
                    <p class="text-lg"><strong>Email:</strong> {{ $customer->email }}</p>
                    <p class="text-lg"><strong>Tel1:</strong> {{ $customer->tel1 }}</p>

                    <form action="{{ route('customer.approve', $customer->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="{{ $customer->id }}">
                        <input type="hidden" name="geslacht" value="{{ $customer->geslacht }}">
                        <input type="hidden" name="voornaam" value="{{ $customer->voornaam }}">
                        <input type="hidden" name="tussenvoegsel" value="{{ $customer->tussenvoegsel }}">
                        <input type="hidden" name="achternaam" value="{{ $customer->achternaam }}">
                        <input type="hidden" name="straatnaam" value="{{ $customer->straatnaam }}">
                        <input type="hidden" name="huisnummer" value="{{ $customer->huisnummer }}">
                        <input type="hidden" name="toevoeging" value="{{ $customer->toevoeging }}">
                        <input type="hidden" name="postcode" value="{{ $customer->postcode }}">
                        <input type="hidden" name="woonplaats" value="{{ $customer->woonplaats }}">
                        <input type="hidden" name="geboortedatum" value="{{ $customer->geboortedatum }}">
                        <input type="hidden" name="iban" value="{{ $customer->iban }}">
                        <input type="hidden" name="tenaamstellng" value="{{ $customer->tenaamstellng }}">
                        <input type="hidden" name="email" value="{{ $customer->email }}">
                        <input type="hidden" name="tel1" value="{{ $customer->tel1 }}">
                        <input type="hidden" name="tel2" value="{{ $customer->tel2 }}">
                        <input type="hidden" name="leverancier" value="{{ $customer->leverancier }}">
                        <input type="hidden" name="saledatum" value="{{ $customer->saledatum }}">
                        <input type="hidden" name="aanbod" value="{{ $customer->aanbod }}">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 mt-4 px-4 w-full rounded">
                            Ik keur goed
                        </button>
                    </form>

                    <div class="mt-8 flex flex-col justify-center">
                        <a href="/consumentenvoorwaarden" target="_blank" class="underline hover:no-underline">Consumenten Voorwaarden</a>
                        <a href="/privacy-policy" target="_blank" class="underline hover:no-underline">Privacy & Policy</a>
                        <a href="/klachtenprocedure" target="_blank" class="underline hover:no-underline">Klachten Procedure</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
