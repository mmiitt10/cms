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
                            ->select('career_industry', DB::raw('SUM(TIMESTAMPDIFF(YEAR, career_work_from, career_work_to)) as total_years'))
                            ->groupBy('career_industry')
                            ->get();

            foreach ($industries as $industry) {
                CareerSummary::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'type' => 'industry',
                        'name' => $industry->career_industry,
                    ],
                    ['total_years' => $industry->total_years]
                );
            }

            // 職種ごとの集計も同様に実施
            $functions = Career::where('user_id', $user->id)
                            ->select('career_function', DB::raw('SUM(TIMESTAMPDIFF(YEAR, career_work_from, career_work_to)) as total_years'))
                            ->groupBy('career_function')
                            ->get();

            foreach ($functions as $function) {
                CareerSummary::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'type' => 'function',
                        'name' => $function->career_function,
                    ],
                    ['total_years' => $function->total_years]
                );
            }
        }

        $this->info('Career summaries have been updated successfully.');
    }
}

// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use App\Models\Career;
// use Illuminate\Support\Facades\DB;

// class UpdateCareerSummaries extends Command
// {
//     /**
//      * The name and signature of the console command.
//      *
//      * @var string
//      */
//     protected $signature = 'app:update-career-summaries';

//     /**
//      * The console command description.
//      *
//      * @var string
//      */
//     protected $description = 'Command description';

//     /**
//      * Execute the console command.
//      */
//     public function handle()
//     {
//         $users = User::all(); // すべてのユーザーを取得

//         foreach ($users as $user) {
//             // 業種ごとの集計
//             // 職種ごとの集計も同様に実施
//             // 集計結果を保存または更新するロジックをここに実装
//         }

//         $this->info('Career summaries have been updated successfully.');
//     }
// }
