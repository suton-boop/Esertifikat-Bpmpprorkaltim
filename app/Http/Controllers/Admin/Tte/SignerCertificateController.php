<?php

namespace App\Http\Controllers\Admin\Tte;

use App\Http\Controllers\Controller;
use App\Models\SignerCertificate;
use App\Domain\Certificates\Services\KeyManagerService;
use App\Domain\Certificates\Services\AuditLogger;
use Illuminate\Http\Request;

class SignerCertificateController extends Controller
{
    public function __construct(
        private KeyManagerService \,
        private AuditLogger \
    ) {}

    public function index()
    {
        \ = SignerCertificate::query()->latest()->paginate(15);
        return view('admin.tte.signers.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tte.signers.create');
    }

    public function store(Request \)
    {
        \ = \->validate([
            'code' => ['required','string','max:50','unique:signer_certificates,code'],
            'name' => ['required','string','max:150'],
            'public_key_pem' => ['required','string'],
            'private_key_pem' => ['required','string'],
            'valid_from' => ['nullable','date'],
            'valid_to' => ['nullable','date','after_or_equal:valid_from'],
        ]);

        // SECURITY: jangan pernah log private_key_pem
        \ = \->keys->createSignerCertificate(
            code: \['code'],
            name: \['name'],
            publicKeyPem: \['public_key_pem'],
            privateKeyPem: \['private_key_pem'],
            createdBy: \->user()->id,
            validFrom: \['valid_from'] ?? null,
            validTo: \['valid_to'] ?? null,
        );

        \->audit->log(
            'signer_certificate.created',
            \->id,
            SignerCertificate::class,
            ['code' => \->code, 'name' => \->name],
            \->user()->id,
            \->ip(),
            \->userAgent()
        );

        return redirect()->route('admin.tte.signers.index')->with('success', 'Signer certificate dibuat.');
    }

    public function deactivate(Request \, string \)
    {
        \ = SignerCertificate::query()->findOrFail(\);
        \->keys->deactivate(\->id);

        \->audit->log(
            'signer_certificate.deactivated',
            \->id,
            SignerCertificate::class,
            ['code' => \->code],
            \->user()->id,
            \->ip(),
            \->userAgent()
        );

        return back()->with('success', 'Signer certificate dinonaktifkan.');
    }
}