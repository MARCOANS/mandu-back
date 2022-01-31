<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="Division",
 *   type="object",
 *   required={"name"},
 *   @OA\Property(property="id",type="integer", format="int64",readOnly=true),
 *   @OA\Property(property="name",type="string",example ="Direccion General",maxLength=45),
 *   @OA\Property(property="parent_division_id",type="integer", format="int64"),
 *   @OA\Property(property="collaborators",type="integer", format="int64"),
 *   @OA\Property(property="level",type="integer", format="int64"),
 *   @OA\Property(property="ambassador",type="string",example ="Eleazar Ortiz Gerhold",maxLength=100),
 * )
 *
 */

class Division extends Model
{
    use HasFactory;

    // protected $with = ['subDivisions'];




    protected $fillable = [
        'name',
        'ambassador',
        'collaborator',
        'parent_division_id',
        'level'

    ];


    public function subDivisions()
    {
        return $this->hasMany(Division::class, 'parent_division_id')->with('subDivisions');
    }

    public function parentDivision()
    {
        return $this->belongsTo(Division::class, 'parent_division_id');
    }

    /*    public function parentDivisions()
       {
           return $this->hasMany(Ubicacion::class, 'id_ubicacion', 'ubicacion_id')->with('ubicacionesPadre');
       } */
}
