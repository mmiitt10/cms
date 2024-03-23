<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Career;
use App\Models\CareerSummary;
use Illuminate\Support\Facades\DB;

class UpdateCareerSummaries extends Command
{
    protected $signature = 'update:career-summaries';
    protected $description = 'Update career summaries for all users';
    
    public function handle()
    {
        // すべてのユーザーを取得
        $users = User::all();
    
        foreach ($users as $user) {
            // 業種ごとの集計
            $industries = Career::where('user_id', $user->id)
                                ->select('career_industry', DB::raw("SUM(TIMESTAMPDIFF(MONTH, career_work_from, COALESCE(career_work_to, CURDATE()))) as total_months"))
                                ->groupBy('career_industry')
                                ->get();
    
            foreach ($industries as $industry) {
                $years = intdiv($industry->total_months, 12); // 年数を計算
    
                CareerSummary::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'type' => 'industry',
                        'name' => $industry->career_industry,
                    ],
                    ['total_years' => $years]
                );
            }
    
            // 職種ごとの集計も同様に実施
            $functions = Career::where('user_id', $user->id)
                                ->select('career_function', DB::raw("SUM(TIMESTAMPDIFF(MONTH, career_work_from, COALESCE(career_work_to, CURDATE()))) as total_months"))
                                ->groupBy('career_function')
                                ->get();
    
            foreach ($functions as $function) {
                $years = intdiv($function->total_months, 12); // 年数を計算
                $months = $function->total_months % 12; // 余った月数を計算
    
                CareerSummary::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'type' => 'function',
                        'name' => $function->career_function,
                    ],
                    ['total_years' => $years]
                );
            }
        }
    
        $this->info('Career summaries have been updated successfully.');
    }
}