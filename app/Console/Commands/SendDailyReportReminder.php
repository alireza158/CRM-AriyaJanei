<?php

namespace App\Console\Commands;

use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendDailyReportReminder extends Command
{
    protected $signature = 'reports:send-reminder';
    protected $description = 'Send SMS reminder at 21:00 to users who have not submitted today report';

    public function handle()
    {
        $excludedUserIds = [17, 43, 42,  1, 30, 36, 26];

        $today = Carbon::today()->toDateString();

        // کاربرانی که امروز گزارش submitted/read ندارند
        $users = User::query()
            ->whereNotIn('id', $excludedUserIds)
            ->whereHas('roles', function ($q) {
                $q->whereIn('name', ['User', 'Marketer', 'Manager']);
            })
            ->whereNotNull('phone') // اگر فیلد phone داری
            ->whereDoesntHave('reports', function ($q) use ($today) {
                $q->whereDate('submitted_at', $today)
                  ->whereIn('status', [Report::STATUS_SUBMITTED, Report::STATUS_READ]);
            })
            ->get();

            $base = User::query()->whereNotIn('id', $excludedUserIds);

$this->info('All (not excluded): '.$base->count());
$this->info('With roles: '.(clone $base)->whereHas('roles', fn($q)=>$q->whereIn('name',['User','Marketer','Manager']))->count());
$this->info('With phone: '.(clone $base)->whereHas('roles', fn($q)=>$q->whereIn('name',['User','Marketer','Manager']))->whereNotNull('phone')->count());
$this->info('Final (need reminder): '.(clone $base)->whereHas('roles', fn($q)=>$q->whereIn('name',['User','Marketer','Manager']))->whereNotNull('phone')->whereDoesntHave('reports', function ($q) use ($today) {
    $q->whereDate('submitted_at', $today)
      ->whereIn('status', [Report::STATUS_SUBMITTED, Report::STATUS_READ]);
})->count());


        $apiKey = '7867584376656655436E6279396C6148302B41774F317A7359486B76634C74324276584C356964677049413D';
        $template = 'report';
        $token = '.'; // یا هر توکنی که توی تمپلیتت تعریف شده

        foreach ($users as $user) {
            try {
                Http::get("https://api.kavenegar.com/v1/{$apiKey}/verify/lookup.json", [
                    'receptor' => $user->phone,
                    'token'    => $token,
                    'template' => $template,
                ]);
            } catch (\Throwable $e) {
                // لاگ خطا (اختیاری)
                \Log::error("SMS failed for user {$user->id} phone {$user->phone}", [
                    'error' => $e->getMessage()
                ]);
            }
        }

        $this->info("Reminders sent to: " . $users->count() . " users.");
        return 0;
    }
}
