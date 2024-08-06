<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedCustomer extends Model
{
    use HasFactory;

    protected $fillable = [ 'id',
    'Geslacht',
    'Voornaam',
    'Tussenvoegsel',
    'Achternaam',
    'Straatnaam',
    'Huisnummer',
    'Toevoeging',
    'Postcode',
    'Woonplaats',
    'Iban',
    'Tenaamstellng',
    'Tel1',
    'Tel2',
    'Leverancier',
    'Saledatum',
    'Aanbod',
    'unique_link', '
    ip_address',
    'user_agent',
    'session_data'];
}
