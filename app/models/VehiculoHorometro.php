<?php
class VehiculoHorometro extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'vehiculo_horometro';
    protected $fillable = array('vehiculo_id','horometro');



public function mantencion()
{
    return $this->belongsTo("Vehiculo");
}



public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            
            
         
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