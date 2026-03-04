<?php

namespace App\Jobs;

use App\Models\Certificate;
use App\Services\CertificatePdfService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateCertificatePdfJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $certificate;

    /**
     * Create a new job instance.
     */
    public function __construct(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * Execute the job.
     */
    public function handle(CertificatePdfService $pdfService): void
    {
        try {
            // Memanggil layanan PDF untuk men-generate file ke disk public
            $pdfPath = $pdfService->generatePdf($this->certificate);

            // Update Certificate Status to Final Generated (Atau langsung Signed jika tidak pakai TTE terpisah)
            // Di sini kita ubah jadi FINAL GENERATED agar tombol Download bisa di klik
            $this->certificate->update([
                'pdf_path' => $pdfPath,
                'status' => Certificate::STATUS_FINAL_GENERATED,
            ]);

            Log::info("Successfully generated PDF for Certificate ID " . $this->certificate->id);
        }
        catch (\Throwable $e) {
            Log::error('PDF generation failed for Certificate ID ' . $this->certificate->id . ': ' . $e->getMessage());
            // Lemparkan lagi exception agar queue mecatatnya sebagai job FAILED
            throw $e;
        }
    }
}
