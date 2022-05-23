<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class ClienteController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Cliente");
    }

    // Listar Clientes API
    public function listarClientes()
    {
        $this->request->allowMethod(["get"]);

        $clientes = $this->Cliente->find()->toList();

        $this->set([
            "status" => true,
            "message" => "Cliente list",
            "data" => $clientes
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Agregar Cliente API
    public function agregarCliente()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        // email address check rules
        $empData = $this->Cliente->find()->where([
            "email" => $formData['email']
        ])->first();

        if (!empty($empData)) {
            // already exists
            $status = false;
            $message = "Email address already exists";
        } else {
            // insert new Cliente
            $empObject = $this->Cliente->newEmptyEntity();

            $empObject = $this->Cliente->patchEntity($empObject, $formData);

            if ($this->Cliente->save($empObject)) {
                // success response
                $status = true;
                $message = "Cliente has been created";
            } else {
                // error response
                $status = false;
                $message = "Failed to create Cliente";
            }
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Modificar Cliente API
    public function modificarCliente()
    {
        $this->request->allowMethod(["put", "post"]);

        $emp_id = $this->request->getParam("id");

        $clienteInfo = $this->request->getData();

        // Cliente check
        $cliente = $this->Cliente->get($emp_id);

        if (!empty($cliente)) {
            // Cliente exists
            $cliente = $this->Cliente->patchEntity($cliente, $clienteInfo);

            if ($this->Cliente->save($cliente)) {
                // success response
                $status = true;
                $message = "Cliente has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update Cliente";
            }
        } else {
            // Cliente not found
            $status = false;
            $message = "Cliente Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Eliminar Cliente api
    public function eliminarCliente()
    {
        $this->request->allowMethod(["delete"]);

        $emp_id = $this->request->getParam("id");

        $cliente = $this->Cliente->get($emp_id);

        if (!empty($cliente)) {
            // Cliente found
            if ($this->Cliente->delete($cliente)) {
                // Cliente deleted
                $status = true;
                $message = "cliente has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete Cliente";
            }
        } else {
            // not found
            $status = false;
            $message = "Cliente doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);
        $this->Cliente->logout();
        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    public function loginCliente()
    {
        $this->request->allowMethod(["post"]);

        $result = $this->Authentication->getResult();

        // debug($result);
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success
            $status = true;
            $message = "Cliente logged in";
            $data = $result->getData();
        } else {
            $status = false;
            $message = "Cliente not found";
            $data = null;
        }

        $this->set([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Obtener Cliente api
    public function obtenerCliente()
    {
        $this->request->allowMethod(["get"]);

        $emp_id = $this->request->getParam("id");

        $cliente = $this->Cliente->get($emp_id);

        if (!empty($cliente)) {
            // Cliente found
            $status = true;
            $message = "Cliente found";
        } else {
            // not found
            $status = false;
            $message = "Cliente not found";
        }

        $this->set([
            "status" => $status,
            "message" => $message,
            "data" => $cliente
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Obtener Cliente por email api
    public function obtenerClientePorEmail()
    {
        $this->request->allowMethod(["get"]);

        $email = $this->request->getParam("email");

        $cliente = $this->Cliente->find()->where([
            "email" => $email
        ])->first();

        if (!empty($cliente)) {
            // Cliente found
            $status = true;
            $message = "Cliente found";
        } else {
            // not found
            $status = false;
            $message = "Cliente not found";
        }

        $this->set([
            "status" => $status,
            "message" => $message,
            "data" => $cliente
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Obtener Cliente por usuario api
    public function obtenerClientePorUsuario()
    {
        $this->request->allowMethod(["get"]);

        $usuario = $this->request->getParam("usuario");

        $cliente = $this->Cliente->find()->where([
            "usuario" => $usuario
        ])->first();

        if (!empty($cliente)) {
            // Cliente found
            $status = true;
            $message = "Cliente found";
        } else {
            // not found
            $status = false;
            $message = "Cliente not found";
        }

        $this->set([
            "status" => $status,
            "message" => $message,
            "data" => $cliente
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }
}
