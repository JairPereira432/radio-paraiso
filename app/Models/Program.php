<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['name','description','host','image','day_type','start_time','end_time','color','active','order'];

    public function getDayLabelAttribute(): string
    {
        return match($this->day_type) {
            'lunes_viernes' => 'Lunes a Viernes',
            'sabados'       => 'Sábados',
            'domingos'      => 'Domingos',
            default         => 'Todos los días',
        };
    }
}