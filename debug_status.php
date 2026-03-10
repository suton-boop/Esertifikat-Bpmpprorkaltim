<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Certificate;

$counts = Certificate::query()
    ->select('status', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
    ->groupBy('status')
    ->get();

echo "Database Certificate Status Counts:\n";
foreach ($counts as $c) {
    echo "- " . ($c->status ?: 'NULL') . ": " . $c->total . "\n";
}

$candidates = Certificate::query()
    ->whereIn('status', ['approved', 'final_generated', 'gagal_tte', 'Gagal_tte'])
    ->count();

echo "\nPotential for Signing Queue: " . $candidates . "\n";
