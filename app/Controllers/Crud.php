<?php

namespace App\Controllers;

use App\Models\CrudModel;

class Crud extends BaseController
{
    public function index(): string
    {
        $crud = new CrudModel();
        $datos = $crud->getNombres();
        $mensaje = session('mensaje');
        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];
        return view('listado', $data);
    }
    public function crear()
    {
        $datos = [
            "nombre" => $_POST['nombre'],
            "apP" => $_POST['paterno'],
            "apM" => $_POST['materno']
        ];
        $crud = new CrudModel();
        $respuesta = $crud->insertar($datos);
        if ($respuesta > 0) {
            return redirect()->to(base_url() . '')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url() . '')->with('mensaje', '0');
        }
    }
    public function actualizar()
    {
        $datos = [
            "nombre" => $_POST['nombre'],
            "apP" => $_POST['paterno'],
            "apM" => $_POST['materno']
        ];
        $idNombre = $_POST['idNombre'];
        $crud = new CrudModel();
        $respuesta = $crud->actualizar($datos,$idNombre);
        if ($respuesta) {
            return redirect()->to(base_url() . '')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '')->with('mensaje', '3');
        }
    }
    public function obtenerNombre($idNombre)
    {
        $data = ["id_nombre"=>$idNombre];
        $crud = new CrudModel();
        $respuesta = $crud->obtenerNombre($data);
        $datos=["datos"=>$respuesta];
        return view('actualizar', $datos);
    }
    public function eliminar($idNombre)
    {
        $crud = new CrudModel();
        $data = [
            "id_nombre"=>$idNombre
        ];
        $respuesta = $crud->eliminar($data);
        if ($respuesta) {
            return redirect()->to(base_url() . '')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '')->with('mensaje', '5');
        }
    }
}
