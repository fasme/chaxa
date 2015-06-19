<?php
class Categoria extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'categoria_archivo';
    protected $fillable = array('nombre');


public function archivo()
{
    return $this->hasMany("Archivo");
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