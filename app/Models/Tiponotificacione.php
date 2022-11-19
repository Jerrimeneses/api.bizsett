<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiponotificacione extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function notificaciones(){
        return $this->hasMany(Notificacione::class);
    }


    protected $allowIncluded=['notificaciones'];


    protected $allowFilter=['id', 'nombre_notificacion'];

    protected $allowSort=['id', 'nombre_notificacion']; 


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
                $query->orderBy($sortField,'asc');
               }
        }
    }
}
