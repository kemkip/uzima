<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;
use Bouncer;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=Bouncer::role()->firstOrCreate([
        'name' => 'Admin',
        'title' => 'Admin',
        ]);

        $user= User::updateOrCreate(
            ['name' => 'Admin'],['name' => 'Admin',
            'email' =>'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => $role->id]
        );    
      
        $models=['User','Role','Country','Patientcategory','Facility','Patient','Diagnosis','Specialization', 'Inreferral','Outreferral', 'Practitioner' ];
        $actions=['Create','View','Edit','Delete'];
        
    

        foreach($models as $model){

          foreach($actions as $action){

                $ability = Bouncer::ability()->firstOrCreate([
                    'name' => $action."_".$model,
                    'title' =>$action." ".$model,
                ]);

                Bouncer::allow($role)->to($ability);
             }

        } 


       
        Bouncer::assign($role)->to($user);
    }
}
