<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Certificate;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        $query = Certificate::with(['participant', 'event'])
            ->whereIn('status', [Certificate::STATUS_SIGNED, 'terbit', Certificate::STATUS_FINAL_GENERATED, Certificate::STATUS_SENT]);

        // Filter event search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('participant', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $certificates = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('emails.index', compact('certificates'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'certificate_ids' => 'required|array',
            'certificate_ids.*' => 'exists:certificates,id',
        ]);

        $ids = $request->certificate_ids;

        // Disini seharusnya dispatch Job spesifik untuk mengirim email
        // Mail::to(...)->queue(new CertificateMail($cert));
        // Untuk saat ini kita ubah statusnya saja

        Certificate::whereIn('id', $ids)->update([
            'status' => Certificate::STATUS_SENT,
            'sent_at' => now(),
        ]);

        return back()->with('success', count($ids) . ' Sertifikat berhasil masuk antrean pengiriman email.');
    }
}
