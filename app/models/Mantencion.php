<?php
class Mantencion extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'mantencion';
    protected $fillable = array('vehiculo_id','mantencionrealizada', 'proximamantencion','fecha_mantencion','horometromantencion','proximahorometro');



public function vehiculo(){
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