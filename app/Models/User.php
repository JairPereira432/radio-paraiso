<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'avatar', 'firebase_uid', 'active'];
    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    // Laravel hashea automáticamente con bcrypt gracias al cast 'hashed'

    public function isAdmin():  bool { return $this->role === 'admin'; }
    public function isEditor(): bool { return in_array($this->role, ['admin', 'editor']); }

    public function news()    { return $this->hasMany(News::class); }
    public function comments(){ return $this->hasMany(Comment::class); }
}