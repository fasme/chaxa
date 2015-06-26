<?php
class Matriz extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'matriz';
    protected $fillable = array('proceso','matriz_actividad_id','matriz_peligro_id','rutinaria','factorseveridad','factorexposicion','factorprobabilidad','resultado','actprevio','totalprevio', 'resultadoprevio', 'acteliminacion', 'totaleliminacion','resultadoeliminacion','actsustitucion','totalsustitucion','resultadosustitucion','actingenieria','totalingenieria','resultadoingenieria','actadministrativo','resultadoadministrativo','actepp', 'totalepp','resultadoepp','magnitud','cambio');




public function muchasactividad()
{
    return $this->belongsToMany("MatrizActividad",'matriz_matriz_actividad','matriz_id','matriz_actividad_id');
}

public function muchasriesgo()
{
    return $this->belongsToMany("MatrizRiesgo",'matriz_matriz_riesgo','matriz_id','matriz_riesgo_id');
}


public function muchascargo()
{
    return $this->belongsToMany("Cargo",'matriz_matriz_cargo','matriz_id','cargo_id');
}

public function peligro()
{
    return $this->belongsTo("MatrizPeligro","matriz_peligro_id");
}


public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
            'actividad_id'     => 'required',
           "riesgo_id" => "required",
           "cargo_id" =>"required",
            
         
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