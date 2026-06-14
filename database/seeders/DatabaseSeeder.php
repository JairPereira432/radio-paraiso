<?php
namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Program;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name'     => 'Administrador',
            'email'    => 'admin@radioparaiso.com',
            'password' => 'Admin1234!',
            'role'     => 'superadmin',
        ]);

        $settings = [
            'radio_name'      => 'Radio Paraíso TV Digital',
            'radio_stream'    => 'https://TU_SERVIDOR:8000/radio',
            'radio_slogan'    => 'Los Grandes Clásicos de la Música',
            'contact_phone'   => '',
            'contact_email'   => '',
            'contact_address' => '',
            'facebook'        => '#',
            'instagram'       => '#',
            'youtube'         => '#',
            'whatsapp'        => '#',
            'tiktok'          => '#',
        ];
        foreach ($settings as $key => $value) {
            SiteSetting::create(['key' => $key, 'value' => $value]);
        }

        $programs = [
            ['name'=>'Buenos Días Paraíso','host'=>'Locutor 1','day_type'=>'lunes_viernes','start_time'=>'06:00:00','end_time'=>'09:00:00','color'=>'#00d4aa','description'=>'El mejor despertar con música y noticias.','order'=>1],
            ['name'=>'Mañanas Clásicas','host'=>'Locutor 2','day_type'=>'lunes_viernes','start_time'=>'09:00:00','end_time'=>'12:00:00','color'=>'#f9c74f','description'=>'Música variada para tu mañana.','order'=>2],
            ['name'=>'Mediodía Musical','host'=>'Locutor 3','day_type'=>'lunes_viernes','start_time'=>'12:00:00','end_time'=>'14:00:00','color'=>'#f8961e','description'=>'Los mejores éxitos al mediodía.','order'=>3],
            ['name'=>'Tardes de Clásicos','host'=>'Locutor 4','day_type'=>'todos','start_time'=>'14:00:00','end_time'=>'18:00:00','color'=>'#90be6d','description'=>'Las mejores baladas de los 70s, 80s y 90s.','order'=>4],
            ['name'=>'Noche de Recuerdos','host'=>'Locutor 5','day_type'=>'todos','start_time'=>'20:00:00','end_time'=>'23:00:00','color'=>'#48cae4','description'=>'Un viaje nocturno por las canciones que marcaron tu vida.','order'=>5],
        ];
        foreach ($programs as $p) { Program::create($p); }
    }
}