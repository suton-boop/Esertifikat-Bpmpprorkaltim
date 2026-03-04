<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SignerCertificate extends Model
{
    use HasUuids;

    protected $table = 'signer_certificates';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'code',
        'name',
        'fingerprint',
        'public_key',
        'private_key_encrypted',
        'is_active',
        'valid_from',
        'valid_to',
        'meta',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
        'meta' => 'array',
    ];
}