<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
    'id',
    'Voornaam',
    'Tussenvoegsel',
    'Achternaam',
    'Straatnaam',
    'Huisnummer',
    'Toevoeging',
    'Postcode',
    'Woonplaats',
    'telefoonnummer',
    'unique_link', '
    ip_address',
    'user_agent',
    'session_data'];
}
