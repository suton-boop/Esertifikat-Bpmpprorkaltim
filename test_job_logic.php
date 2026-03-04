<?php
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$signerCertCode = "SIGNER-001";
$signer = \App\Models\SignerCertificate::query()->where("code", $signerCertCode)->first();
echo "Found signer: " . ($signer ? "YES" : "NO") . "\n";
if ($signer) {
    echo "ID: " . $signer->id . "\n";
}
