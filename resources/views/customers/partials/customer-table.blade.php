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
