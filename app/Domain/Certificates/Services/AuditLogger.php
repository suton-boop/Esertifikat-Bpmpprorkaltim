<?php

namespace App\Domain\Certificates\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditLogger
{
    public function log(
        string \,
        ?string \ = null,
        ?string \ = null,
        array \ = [],
        ?int \ = null,
        ?string \ = null,
        ?string \ = null
    ): AuditLog {
        \ = AuditLog::query()->latest('created_at')->first();
        \ = \->hash;

        \ ??= Auth::id();

        \ = [
            'event_type' => \,
            'subject_id' => \,
            'subject_type' => \,
            'actor_id' => \,
            'actor_ip' => \,
            'actor_user_agent' => \,
            'metadata' => \,
            'prev_hash' => \,
            'ts' => now()->toISOString(),
        ];

        \ = hash('sha256', json_encode(\, JSON_UNESCAPED_SLASHES));

        return AuditLog::query()->create([
            'event_type' => \,
            'subject_id' => \,
            'subject_type' => \,
            'actor_id' => \,
            'actor_ip' => \,
            'actor_user_agent' => \,
            'metadata' => \,
            'prev_hash' => \,
            'hash' => \,
        ]);
    }
}