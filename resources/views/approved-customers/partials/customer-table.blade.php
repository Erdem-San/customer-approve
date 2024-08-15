@foreach($customers as $index => $customer)
    <tr>
        <td class="py-2 px-4 border-b">{{ ($customers->currentPage() - 1) * $customers->perPage() + $index + 1 }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->ip_address }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->user_agent }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->voornaam }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->tussenvoegsel }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->achternaam }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->straatnaam }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->huisnummer }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->toevoeging }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->postcode }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->woonplaats }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->email }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->telefoonnummer }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->created_at }}</td>
    </tr>
@endforeach
