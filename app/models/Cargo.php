<?php
class Cargo extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cargo';
    protected $fillable = array('nombre');



public function machasmatriz()
{
    return $this->belongsToMany("Matriz",'matriz_matriz_cargo','cargo_id','matriz_id');
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