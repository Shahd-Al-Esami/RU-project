<?php

namespace App\Exports;

use App\Models\Food;
use App\Models\Plan;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PlanExport implements FromCollection, WithStyles
{
        private $planId;
        public function __construct($planId)
        {
            $this->planId = $planId;
        }

        public function collection()
        {
            $plan = Plan::with('descriptionPlans')->where('id', $this->planId)->get();
            $data = $plan->map(function ($plan) {
                $week = $plan->descriptionPlans->week;
                $day = $plan->descriptionPlans->day;
                $meal = $plan->descriptionPlans->meal;
                $meal = $plan->descriptionPlans->meal;

                 $food_id=$plan->descriptionPlans->food_id;
                $food= Food::where('id',$food_id)->first();
                   foreach($food->ingredients as $ingredient){
                               $ingredient_name=$ingredient->name;
                               $ingredient_calory=$ingredient->calories;
                            }

                return [
                    'id'                => $plan->id,
                    'title'             => $plan->title,
                    'start_date'        => $plan->start_date,
                    'end_date'          => $plan->end_date,

                    'patient_id'        => $plan->planOrder->patient_id,
                    'doctor_id'         => $plan->planOrder->doctor_id,

                    'week'              => $week,
                    'day'               => $day,
                    'meal'              => $meal,
                    'food_id'            => $food->name,
                    'calories'           => $food->calories,

                    'name'                => $ingredient_name,
                    'ingredient_calory'   => $ingredient_calory,



                ];
            });

            $data->prepend([
                'patient_id' => 'Patient',
                'doctor_id' => 'Doctor',
                'id' => 'ID',
                'title' => 'Title',
                'start_date' => 'Start Date',
                'end_date' => 'End Date',

                'week' => 'Week',
                'day' => 'Day ',
                'meal' => 'Meal',
                'food_id' => 'Food',
                'calories' => 'Calory',

                'ingredient_calory' => 'Calory of this Ingredient',
                'ingredient_name' => 'Name of this Ingredient',

            ]);

            return $data;
        }



    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => '4682B4'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ]
        ]);

        $sheet->getStyle('A1:H' . (count($this->collection()) + 1))->applyFromArray([
            'border' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
