<?php

class UsuarioController
{
    public function __construct()
    {
        require_once "models/Usuario.php";
    }

    public function index()
    {
        $usuarios = new Usuario();
        $data["titulo"] = "Usuarios";
        $data["usuarios"] = $usuarios->listar();

        // Cargar la vista
        require_once "views/usuarios/index.php";
    }

    // Mostrar la vista para crear el registro (Proyecto)
    public function insert()
    {
        $usuario = new Usuario();
        $data['titulo'] = "Crear Usuario";
        $data['cargos'] = $usuario->obtenerCargos(); // Obtener los cargos

        require_once "views/usuarios/insert.php";
    }

    // Guardar la información en la DB
    public function store()
    {
        // recibir los datos del formulario
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];
        $id_cargo = $_POST['id_cargo'];

        // Guardar el registro
        $usuarios = new Usuario();
        $usuarios->insert($nombre_usuario, $contraseña, $id_cargo);

        // Enviar a la vista index
        $this->index();
    }

    // Visualizar la información de un registro
    public function view($id_usuario)
    {
        $usuarios = new Usuario();
        $data['titulo'] = "Detalle del Usuario";
        $data['usuarios'] = $usuarios->getUsuario($id_usuario);
        require_once "views/usuarios/view.php";
    }

    public function edit($id_usuario)
    {
        $usuarios = new Usuario();
        $data['titulo'] = "Actualizar usuario";
        $data['usuarios'] = $usuarios->getUsuario($id_usuario);
        $data['id_usuario'] = $id_usuario;
        $data['cargos'] = $usuarios->obtenerCargos(); // Obtener los cargos        
        require_once "views/usuarios/edit.php";
    }

    public function update()
    {
        // recibir los datos del formulario
        $id_usuario = $_POST['id_usuario'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];
        $id_cargo = $_POST['id_cargo'];

        $usuarios = new Usuario();
        $usuarios->update($id_usuario, $nombre_usuario, $contraseña, $id_cargo);
        $this->index();
    }

    public function delete($id_usuario)
    {
        $usuarios = new Usuario();
        $usuarios->delete($id_usuario);
        $this->index();
    }
}

?>