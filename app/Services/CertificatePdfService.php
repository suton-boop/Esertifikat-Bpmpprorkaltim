<?php

namespace App\Services;

use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificatePdfService
{
    /**
     * Generate PDF dan simpan ke storage/app/public/...
     * Return: pdf_path RELATIF untuk disk('public') mis: certificates/2026/event-1/xxx.pdf
     */
    public function generatePdf(Certificate $certificate): string
    {
        $certificate->loadMissing(['event.certificateTemplate', 'participant']);

        if (!$certificate->event) {
            throw new \RuntimeException('Event tidak ditemukan pada sertifikat.');
        }
        if (!$certificate->participant) {
            throw new \RuntimeException('Peserta tidak ditemukan pada sertifikat.');
        }
        if (!$certificate->event->certificate_template_id) {
            throw new \RuntimeException('Event belum memilih Template Sertifikat.');
        }

        $template = $certificate->event->certificateTemplate;
        if (!$template) {
            throw new \RuntimeException('Template sertifikat tidak ditemukan pada event.');
        }

        // ====== BACKGROUND (base64) untuk dompdf ======
        $bgDataUri = null;
        $bgDataUri2 = null;

        // ====== BACKGROUND 1 ======
        $bgRel = $template->file_path ?? $template->background_path ?? null;
        if (is_string($bgRel) && trim($bgRel) !== '') {
            $bgRel = ltrim(preg_replace('#^storage/#', '', $bgRel), '/');
            if (Storage::disk('public')->exists($bgRel)) {
                $bgFull = Storage::disk('public')->path($bgRel);
                $ext = strtolower(pathinfo($bgFull, PATHINFO_EXTENSION));
                if (in_array($ext, ['png', 'jpg', 'jpeg'], true)) {
                    $mime = $ext === 'png' ? 'image/png' : 'image/jpeg';
                    $bgDataUri = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($bgFull));
                }
            }
        }

        // ====== BACKGROUND 2 ======
        $bgRel2 = $template->page_2_background_path ?? null;
        if (is_string($bgRel2) && trim($bgRel2) !== '') {
            $bgRel2 = ltrim(preg_replace('#^storage/#', '', $bgRel2), '/');
            if (Storage::disk('public')->exists($bgRel2)) {
                $bgFull2 = Storage::disk('public')->path($bgRel2);
                $ext2 = strtolower(pathinfo($bgFull2, PATHINFO_EXTENSION));
                if (in_array($ext2, ['png', 'jpg', 'jpeg'], true)) {
                    $mime2 = $ext2 === 'png' ? 'image/png' : 'image/jpeg';
                    $bgDataUri2 = 'data:' . $mime2 . ';base64,' . base64_encode(file_get_contents($bgFull2));
                }
            }
        }

        // folder rapi per tahun & event
        $year = (int)($certificate->year ?? optional($certificate->event->start_date)->year ?? date('Y'));
        $folder = "certificates/{$year}/event-{$certificate->event_id}";

        // nama file aman
        $safeName = Str::slug($certificate->participant->name ?: 'peserta');
        $fileName = $certificate->certificate_number
            ?Str::slug($certificate->certificate_number)
            : "cert-{$certificate->id}";

        $file = "{$fileName}-{$safeName}.pdf";
        $relativePath = "{$folder}/{$file}";

        // Render PDF
        $pdf = Pdf::loadView('certificates.pdf', [
            'certificate' => $certificate,
            'event' => $certificate->event,
            'participant' => $certificate->participant,
            'template' => $template,
            'bgDataUri' => $bgDataUri, // ✅ dipakai di blade
            'bgDataUri2' => $bgDataUri2,
        ])->setPaper('a4', 'landscape');

        Storage::disk('public')->put($relativePath, $pdf->output());

        if (!Storage::disk('public')->exists($relativePath)) {
            throw new \RuntimeException('PDF gagal disimpan ke storage public.');
        }

        return $relativePath;
    }
}
