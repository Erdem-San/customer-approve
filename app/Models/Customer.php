<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted(): void
    {
        static::creating(function (Customer $customer) {
            $customer->id = Str::uuid()->toString();
        });

        static::created(function (Customer $customer) {
            $customer->update([
                'unique_link' => url('/customer/' . $customer->id),
            ]);
        });
    }

    protected $fillable = [
        'id', 'ad', 'soyad', 'ev_no', 'posta_kodu', 'sehir', 'mail', 'tel_no', 'unique_link'
    ];
}