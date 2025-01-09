<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class ModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'User', 'friendly' => 'Manage Users'],
            ['id' => 2, 'name' => 'Role', 'friendly' => 'Manage Roles'], 
            ['id' => 3, 'name' => 'Country', 'friendly' => 'Manage Countries'], 
            ['id' => 4, 'name' => 'Patientcategory', 'friendly' => 'Manage Patient Categories'], 
            ['id' => 5, 'name' => 'Facility', 'friendly' => 'Manage Facilities'], 
            ['id' => 6, 'name' => 'Patient', 'friendly' => 'Manage Patients'], 
            ['id' => 7, 'name' => 'Diagnosis', 'friendly' => 'Manage Diagnoses'], 
            ['id' => 8, 'name' => 'Specialization', 'friendly' => 'Manage Specializations'], 
            ['id' => 9, 'name' => 'Inreferral', 'friendly' => 'Manage Inreferrals'], 
            ['id' => 10, 'name' => 'Outreferral', 'friendly' => 'Manage Outreferrals'], 
            ['id' => 11, 'name' => 'Practitioner', 'friendly' => 'Manage Practitioners'], 

                        
                 

        ];

        foreach ($items as $item) {

            $matchThese=['id'=>$item['id']];

            \App\Models\Mo::updateOrCreate($matchThese,$item);           

            
        }
    }
}
