<?php
class Archivo extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'archivo';
    protected $fillable = array('nombre','categoria_id','archivo', 'extension','codigo','version','tiempo');



public function categoria()
{
    return $this->belongsTo("Categoria");
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