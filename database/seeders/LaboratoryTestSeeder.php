<?php

namespace Database\Seeders;

use App\Models\LaboratoryTestGroup;
use Illuminate\Database\Seeder;

class LaboratoryTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->laboratoryTests() as $testGroup => $tests) {
            $laboratoryTestGroup = LaboratoryTestGroup::create(['name' => $testGroup]);

            foreach ($tests as $test) {
                $laboratoryTestGroup->laboratoryTests()->create(['name' => $test]);
            }
        }
    }

    public function laboratoryTests(): array
    {
        return [
            'x-ray' => [
                'Chest',
                'Cervical Vertebrae',
                'Thoracic Vertebrae',
                'Lumvar Vertebrae',
                'Lumbo Sacral Vertebrae',
                'Thoraco Lumbar Vertrbrae',
                'Wrist Joint',
                'Thoracic Inlet',
                'Shoulder Joint',
                'Elbow Joint',
                'Knee Joint',
                'Sacro LLiac Joint',
                'Pelvic Joint',
                'Hip Joint',
                'Femoral',
                'Ankle',
                'Humerus',
                'Radius/Ulner',
                'Foot',
                'Tibia/Fibula',
                'Fingers',
                'Toes',
            ],
            'Ultrasound Scan' => [
                'Obsteric',
                'Abdominal',
                'Pelvis',
                'Prostrate',
                'Breast',
                'Thyroid',
            ],
            'MRI' => [
                'Breast',
                'Cardiac',
                'Magnetic Resonance Venography',
                'Non-Contrast MRA',
                'Open, High-Field',
            ],
            'CT Scan' => [
                'Abdomen and pelvis',
                'Axial skeleton and extremities',
                'Cardiac',
                'Neck',
                'Lungs',
                'HEAD',
            ],
        ];
    }
}
