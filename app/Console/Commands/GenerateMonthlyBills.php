<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\PlanOrder;
use App\Models\MonthBills;
use Illuminate\Console\Command;

class GenerateMonthlyBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-monthly-bills';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // استرجاع جميع الأطباء
        $users=User::where('role','doctor')->get();

        foreach ($users as $user) {

            $doctor_id=$user->id;
            $total = PlanOrder::where('doctor_id', $doctor_id)->sum('price'); //لنجمع اسعار كل الخطط اللي مشتغلها الطبيب

            $bill=0.4 * $total ;//40% من فاتورة الطبيب للادمن

            MonthBills::create([
                'user_id' => $doctor_id,
                'isPaid' => false,
                'price' => $bill,
                'billing_date' => now(),
            ]);
    }
}
}
