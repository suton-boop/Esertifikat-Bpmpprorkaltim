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

        // Batasi maksimal 200 email per klik
        $toProcess = array_slice($ids, 0, 200);

        Certificate::whereIn('id', $toProcess)->update([
            'status' => Certificate::STATUS_SENT,
            'sent_at' => now(),
        ]);

        $msg = count($toProcess) . ' Sertifikat masuk antrean pengiriman.';
        if (count($ids) > 200) {
            $msg .= ' (Sisa ' . (count($ids) - 200) . ' data diproses pada batch berikutnya).';
        }

        return back()->with('success', $msg);
    }
}
