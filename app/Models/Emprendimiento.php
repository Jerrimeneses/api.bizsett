<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Emprendimiento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ciudade(){
        return $this->belongsTo(Ciudade::class);
    }

    public function inversionistas(){
        return $this->hasMany(Inversionista::class);
    }

    public function empleos(){
        return $this->hasMany(Empleo::class);
    }

    public function publicaciones(){
        return $this->hasMany(Publicacione::class);
    }
    
    public function followers(){
        return $this->hasMany(Follower::class);
    }

    protected $allowIncluded=['user', 'ciudade', 'publicaciones', 'followers', 'empleos', 'inversionistas', 'followers.user'];

    protected $allowFilter=['id', 'nombre_emprendimiento', 'clasificacion', 'descripcion'];

    protected $allowSort=['id', 'nombre_emprendimiento', 'clasificacion', 'descripcion']; 

    public function scopeIncluded(Builder $query){
       
        if(empty($this->allowIncluded)||empty(request('included'))){
            return;
        }
        $relations = explode(',', request('included'));//['post','relation2']
        
        $allowIncluded=collect($this->allowIncluded);//colocamos en una colecion lo que tiene $allowIncluded en este caso = ['publicaciones', 'publicaciones.emprendimiento']
        
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
                $query->orderBy($sortField,'desc');
               }
        }
    }
}
