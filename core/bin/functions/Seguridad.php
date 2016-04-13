<?php

  /**
   *
   */
  class Seguridad
  {

    private $nstring;

    /*function __construct(argument)
    {
      # code...
    }*/

    public function XSS($string){
      #Evita ataques XSS,posible cambio para crear una funcion de seguridad
      $this->nstring = str_replace(
      array('<script>','</script>','<script src','<script type='),
      '',
      $string
      );

      return $this->nstring;

    }
  }


 ?>
