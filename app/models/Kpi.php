<?php
class Kpi extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'kpi';
    protected $fillable = array('meta','kpiobjetivo_id');



/*
public function actividadKpi()
{
    return $this->hasMany("ActividadKpi");
}
*/

public function kpiobjetivo()
{
    return $this->BelongsTo("kpiobjetivo");
}

    public function muchaspersonal()
{
    return $this->belongsToMany("Personal",'actividad_kpi','kpi_id','personal_id')
    ->withpivot("id","actividad","frecuencia","tipoplan","personal_admin_id","id", "estado","adjunto1", "adjunto2","adjunto3","adjunto4","adjunto5",'fechaenvio')

    ->withTimestamps();
}


public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
          //  'cliente_id'     => 'exists:cliente,id',
          //  "guiavalue" => "required",
            
         
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }





}
?>