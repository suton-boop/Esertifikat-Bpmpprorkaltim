<?php

namespace App\Domain\Certificates\Services;

use App\Domain\Certificates\Models\Certificate;
use App\Domain\Certificates\Models\DigitalSignature;
use App\Models\SignerCertificate;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Storage;

class VerificationService
{
    public function verifyRemote(string \, string \): array
    {
        try {
            \ = JWT::decode(\, new Key(\, 'HS256'));
            \ = (int)\->sub;

            \ = Certificate::query()->with(['participant', 'event'])->findOrFail(\);
            \ = DigitalSignature::query()->where('certificate_id', \->id)->firstOrFail();
            \ = SignerCertificate::query()->findOrFail(\->signer_certificate_id);

            return [
                'success' => true,
                'certificate' => \,
                'signature' => \,
                'signer' => \,
                'signed_at' => \->signed_at,
            ];
        } catch (\Exception \) {
            return [
                'success' => false,
                'message' => \->getMessage(),
            ];
        }
    }
}