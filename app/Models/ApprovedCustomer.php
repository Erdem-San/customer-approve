<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
    'id',
    'voornaam',
    'tussenvoegsel',
    'achternaam',
    'straatnaam',
    'huisnummer',
    'toevoeging',
    'postcode',
    'woonplaats',
    'email',
    'telefoonnummer',
    'unique_link',
    'ip_address',
    'user_agent',
    'session_data'];
}
