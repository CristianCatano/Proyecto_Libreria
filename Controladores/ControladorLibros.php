<?php

class ControladorLibros extends ControladorBase {
   public function listado() {
        $this->mostrarVista("libros", "listado");
   } 

   public function crear() {
        $this->mostrarVista("libros", "crear");
   }
}