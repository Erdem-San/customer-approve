<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedCustomer extends Model
{
    use HasFactory;

    protected $fillable = [ 'ad', 'soyad', 'ev_no', 'posta_kodu', 'sehir', 'mail', 'tel_no', 'unique_link'];
}
