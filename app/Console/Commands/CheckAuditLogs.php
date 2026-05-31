<?php

namespace App\Console\Commands;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Console\Command;

class CheckAuditLogs extends Command
{
    protected $signature = 'audit:check {user_id?}';

    protected $description = 'Check audit logs for a user or show recent logs';

    public function handle()
    {
        $userId = $this->argument('user_id');

        if ($userId) {
            $user = User::find($userId);
            if (! $user) {
                $this->error("User with ID $userId not found");

                return 1;
            }

            $this->info("Audit logs for user: {$user->name} ({$user->email})");
            $this->newLine();

            $logs = AuditLog::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        } else {
            $this->info('Recent audit logs (all users)');
            $this->newLine();

            $logs = AuditLog::with('user')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }

        if ($logs->isEmpty()) {
            $this->warn('No audit logs found');

            return 0;
        }

        $headers = ['ID', 'User', 'Action', 'Description', 'IP', 'Created At'];
        $rows = [];

        foreach ($logs as $log) {
            $rows[] = [
                $log->id,
                $log->user ? $log->user->name : 'N/A',
                $log->action,
                $log->description,
                $log->ip_address,
                $log->created_at->format('Y-m-d H:i:s'),
            ];
        }

        $this->table($headers, $rows);

        return 0;
    }
}
