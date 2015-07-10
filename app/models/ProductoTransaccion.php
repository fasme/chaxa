<?php
class ProductoTransaccion extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'producto_transaccion';
    protected $fillable = array('producto_id','tipo','cantidad');



public function producto()
{
    return $this->belongsTo("Producto");
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