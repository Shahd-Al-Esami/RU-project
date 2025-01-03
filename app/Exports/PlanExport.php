<?php

namespace App\Exports;

use App\Models\Food;
use App\Models\Plan;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// class PlanExport implements FromCollection, WithStyles
{
//     private $planId;

//     public function __construct($planId)
//     {
//         $this->planId = $planId;
//     }

//     public function collection()
//     {
//         $plan = Plan::with('descriptionPlans')->where('id', $this->planId)->first();

//         $data = [];
//         if ($plan) {
//             $patient_id = $plan->planOrder->patient_id;
//             $doctor_id = $plan->planOrder->doctor_id;

//             // Fetch patient and doctor names
//             $patient = User::find($patient_id)->name ?? 'Unknown';
//             $doctor = User::find($doctor_id)->name ?? 'Unknown';

//             foreach ($plan->descriptionPlans as $description) {
//                 $food = Food::find($description->food_id);
//                 if ($food) {
//                     foreach ($food->ingredients as $ingredient) {
//                         $data[] = [
//                             'id'             => $plan->id,
//                             'title'          => $plan->title,
//                             'start_date'     => $plan->start_date,
//                             'end_date'       => $plan->end_date,
//                             'patient_id'     => $patient,
//                             'doctor_id'      => $doctor,
//                             'week'           => $description->week,
//                             'day'            => $description->day,
//                             'meal'           => $description->meal,
//                             'food_id'        => $food->name,
//                             'calories'       => $food->calories,
//                             'ingredient_name' => $ingredient->name,
//                             'ingredient_calory' => $ingredient->calories,
//                         ];
//                     }
//                 }
//             }
//         }

//         // Prepend the header row
//         array_unshift($data, [
//             'patient_id' => 'Patient',
//             'doctor_id' => 'Doctor',
//             'id' => 'ID',
//             'title' => 'Title',
//             'start_date' => 'Start Date',
//             'end_date' => 'End Date',
//             'week' => 'Week',
//             'day' => 'Day',
//             'meal' => 'Meal',
//             'food_id' => 'Food',
//             'calories' => 'Calories',
//             'ingredient_name' => 'Ingredient Name',
//             'ingredient_calory' => 'Calory of Ingredient',
//         ]);

//         return collect($data);
//     }

//     public function styles(Worksheet $sheet)
//     {
//         $sheet->getStyle('A1:L1')->applyFromArray([
//             'font' => [
//                 'bold' => true,
//                 'color' => ['argb' => 'FFFFFF'],
//                 'size' => 12,
//             ],
//             'fill' => [
//                 'fillType' => 'solid',
//                 'startColor' => ['argb' => '4682B4'],
//             ],
//             'alignment' => [
//                 'horizontal' => 'center',
//                 'vertical' => 'center',
//             ],
//         ]);

//         $sheet->getStyle('A1:L' . (count($this->collection())))->applyFromArray([
//             'border' => [
//                 'allBorders' => [
//                     'borderStyle' => Border::BORDER_THICK,
//                     'color' => ['argb' => '000000'],
//                 ],
//             ],
//         ]);

//         foreach (range('A', 'L') as $columnID) {
//             $sheet->getColumnDimension($columnID)->setAutoSize(true);
//         }
//     }
 }
