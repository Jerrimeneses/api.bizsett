<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notificaciones(){
        return $this->hasMany(Notificacione::class);
    }

    public function chats(){
        return $this->hasMany(Chat::class);
    }

    public function buzons(){
        return $this->hasMany(Buzon::class);
    }

    public function emprendimiento(){
        return $this->hasOne(Emprendimiento::class);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function reacciones(){
        return $this->hasMany(Reaccione::class);
    }

    public function tipodocumento(){
        return $this->belongsTo(Tipodocumento::class);
    }

    public function tipopersona(){
        return $this->belongsTo(Tipopersona::class);
    }

    public function inversionistas(){
        return $this->hasMany(Inversionista::class);
    }

    public function empleos(){
        return $this->hasMany(Empleo::class);
    }

    public function followers(){
        return $this->hasMany(Follower::class);
    }



    public function setPasswordAttribute($password){
        $this->attributes['password']= bcrypt($password);
    }

    
    protected $allowIncluded=[  'emprendimiento', 
                                'emprendimiento.user', 
                                'followers', 
                                'empleos', 
                                'inversionistas',
                                'tipopersona', 
                                'tipodocumento',  ];

    protected $allowFilter=['email',
                            'password',
                            'nombre',
                            'apellidos',
                            'telefono',
                            'numero_documento',
                            'direccion',];

    protected $allowSort=[  'email',
                            'password',
                            'nombre',
                            'apellidos',
                            'telefono',
                            'numero_documento',
                            'direccion',];

    public function scopeIncluded(Builder $query){
       
        if(empty($this->allowIncluded)||empty(request('included'))){
            return;
        }
        $relations = explode(',', request('included'));//['post','relation2']
        
        $allowIncluded=collect($this->allowIncluded);//colocamos en una colecion lo que tiene $allowIncluded en este caso = ['posts','posts.user']
        
        foreach($relations as $key => $relationship){//recorremos el array de relaciones
            
            if(!$allowIncluded->contains($relationship)){
                unset($relations[$key]);
            }
        
        }

        $query->with($relations);
     
    }



    public function scopeFilter(Builder $query){
        if(empty($this->allowFilter) || empty(request('filter'))){
            return ;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {

                //$query->where($filter, $value);
                $query->where($filter,'LIKE','%'.$value.'%');
            }
        }
    }



    public function scopeSort(Builder $query)
    {

        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',',request('sort')) ;
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {
            
            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField,'asc');
               }
        }
    }


}
