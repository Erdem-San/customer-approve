<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Klantenlijst') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between space-x-2 mb-4">
                        <div class="flex items-center space-x-2">
                            <form id="importForm" action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data" class="flex items-center">
                                @csrf
                                <input type="file" name="xlsx_file" required class="mr-2">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Importeren
                                </button>
                            </form>

                            <a href="{{ route('customers.export') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Exporteren
                            </a>
                        </div>

                        <form action="{{ route('customers.delete_all') }}" method="POST" onsubmit="return confirm('Weet u zeker dat u alle klantgegevens wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Verwijder alle klanten
                            </button>
                        </form>
                    </div>

                    <!-- Yükleme göstergesi ve ilerleme çubuğu -->
                    <div id="importProgress" class="hidden mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                        <p id="progressText" class="mt-2 text-center">Laden: 0%</p>
                    </div>

                    <div class="mb-4">
                        <input type="text" name="search" id="search" class="w-full border border-gray-300 p-2 rounded" placeholder="Zoek naar klanten..." />
                    </div>

                    <h2 class="text-2xl font-bold mb-4">Klantenlijst</h2>

                    <div class="overflow-x-auto">
                        <table id="customersTable" class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b"></th>
                                    <th class="py-2 px-4 border-b">Geslacht</th>
                                    <th class="py-2 px-4 border-b">Voornaam</th>
                                    <th class="py-2 px-4 border-b">Tussenvoegsel</th>
                                    <th class="py-2 px-4 border-b">Achternaam</th>
                                    <th class="py-2 px-4 border-b">Straatnaam</th>
                                    <th class="py-2 px-4 border-b">Huisnummer</th>
                                    <th class="py-2 px-4 border-b">Toevoeging</th>
                                    <th class="py-2 px-4 border-b">Postcode</th>
                                    <th class="py-2 px-4 border-b">Woonplaats</th>
                                    <th class="py-2 px-4 border-b">Iban</th>
                                    <th class="py-2 px-4 border-b">Tenaamstelling</th>
                                    <th class="py-2 px-4 border-b">Tel 1</th>
                                    <th class="py-2 px-4 border-b">Tel 2</th>
                                    <th class="py-2 px-4 border-b">Leverancier</th>
                                    <th class="py-2 px-4 border-b">Saledatum</th>
                                    <th class="py-2 px-4 border-b">Aanbod</th>
                                    <th class="py-2 px-4 border-b">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $index => $customer)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ ($customers->currentPage() - 1) * $customers->perPage() + $index + 1 }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->geslacht }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->voornaam }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->tussenvoegsel }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->achternaam }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->straatnaam }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->huisnummer }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->toevoeging }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->postcode }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->woonplaats }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->iban }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->tenaamstellng }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->tel1 }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->tel2 }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->leverancier }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->saledatum }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->aanbod }}</td>
                                        <td class="py-2 px-4 border-b">{{ $customer->unique_link }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#importForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#importProgress').removeClass('hidden');
                    $('#progressBar').css('width', '0%');
                    $('#progressText').text('Bezig met laden: 0%');

                    // Simüle edilmiş ilerleme
                    let percentComplete = 0;
                    const interval = setInterval(function() {
                        percentComplete += 10;
                        $('#progressBar').css('width', percentComplete + '%');
                        $('#progressText').text('Bezig met laden: ' + percentComplete + '%');

                        if (percentComplete >= 90) {
                            clearInterval(interval);
                        }
                    }, 500);
                },
                success: function(response) {
                    alert('Importeren succesvol!');
                    location.reload(); // Sayfayı yenile
                },
                error: function() {
                    alert('Er is een fout opgetreden tijdens het importeren.');
                },
                complete: function() {
                    $('#progressBar').css('width', '100%');
                    $('#progressText').text('Bezig met laden: 100%');
                    setTimeout(function() {
                        $('#importProgress').addClass('hidden');
                    }, 1000);
                }
            });
        });

        $(document).on('keyup', '#search', function(e) {
            e.preventDefault();
            let search_string = $(this).val();
            $.ajax({
                url: "{{ route('customers.search') }}",
                method: 'GET',
                data: { search_string: search_string },
                success: function(res) {
                    if (res.status !== 'nothing_found') {
                        $('#customersTable tbody').html(res);
                    } else {
                        $('#customersTable tbody').html('<tr><td colspan="17" class="text-center py-2">Geen resultaten gevonden.</td></tr>');
                    }
                }
            });
        });
    });
</script>

    @endpush
</x-app-layout>
