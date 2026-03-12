<?php

use Illuminate\Support\Facades\Artisan;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$app->boot();

echo "<h1>Troubleshooting Project Sertifikat</h1>";

try {
    echo "<li>Membersihkan cache... ";
    Artisan::call('optimize:clear');
    echo "<b>OK</b></li>";

    echo "<li>Mencoba memproses antrian (max 5 data)... <br><pre>";
    Artisan::call('queue:work', [
        '--queue' => 'tte-signing,default',
        '--stop-when-empty' => true,
        '--tries' => 1
    ]);
    echo Artisan::output();
    echo "</pre><b>Selesai</b></li>";

} catch (\Exception $e) {
    echo "<li><b>Error:</b> " . $e->getMessage() . "</li>";
}

echo "<br><a href='/admin/monitoring'>Kembali ke Monitoring</a>";
