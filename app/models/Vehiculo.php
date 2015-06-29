<?php
class Vehiculo extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'vehiculo';
    protected $fillable = array('familia','tipo','ninterno','patente','marca','modelo','horometro');



public function mantencion()
{
    return $this->hasMany("Mantencion");
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