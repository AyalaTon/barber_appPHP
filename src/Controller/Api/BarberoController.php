<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

class BarberoController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Barbero");
    }

    // Listar Barberos API
    public function listarBarberos()
    {
        $this->request->allowMethod(["get"]);

        $barberos = $this->Barbero->find()->toList();

        $this->set([
            "status" => true,
            "message" => "Barbero list",
            "data" => $barberos
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Agregar Barbero API
    public function agregarBarbero()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        // email address check rules
        $empData = $this->Barbero->find()->where([
            "email" => $formData['email']
        ])->first();

        if (!empty($empData)) {
            // already exists
            $status = false;
            $message = "Email address already exists";
        } else {
            // insert new Barbero
            $empObject = $this->Barbero->newEmptyEntity();

            $empObject = $this->Barbero->patchEntity($empObject, $formData);

            if ($this->Barbero->save($empObject)) {
                // success response
                $status = true;
                $message = "Barbero has been created";
            } else {
                // error response
                $status = false;
                $message = "Barbero could not be created";
            }
        }

        $this->set([
            "status" => $status,
            "message" => $message,
            "data" => $empObject
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // modificar Barbero API
    public function modificarBarbero()
    {
        $this->request->allowMethod(["put"]);

        $barbero_id = $this->request->getParam("id");

        $barberoInfo = $this->request->getData();

        //barbero check
        $barbero = $this->Cliente->get($barbero_id);

        if (!empty($barbero)) {
            $barbero = $this->Barbero->patchEntity($barbero, $barberoInfo);

            if ($this->Barbero->save($barbero)) {
                // success response
                $status = true;
                $message = "Barbero has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update Barbero";
            }
        } else {
            // error response
            $status = false;
            $message = "Barbero not found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Eliminar Barbero API
    public function eliminarBarbero()
    {
        $this->request->allowMethod(["delete"]);

        $barbero_id = $this->request->getParam("id");

        // Barbero check
        $barbero = $this->Barbero->get($barbero_id);

        if (!empty($barbero)) {
            if ($this->Barbero->delete($barbero)) {
                // success response
                $status = true;
                $message = "Barbero has been deleted";
            } else {
                // error response
                $status = false;
                $message = "Failed to delete Barbero";
            }
        } else {
            // error response
            $status = false;
            $message = "Barbero not found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Obtener Barbero API
    public function obtenerBarbero()
    {
        $this->request->allowMethod(["get"]);

        $barbero_id = $this->request->getParam("id");

        // Barbero check
        $barbero = $this->Barbero->get($barbero_id);

        if (!empty($barbero)) {
            // success response
            $status = true;
            $message = "Barbero found";
        } else {
            // error response
            $status = false;
            $message = "Barbero not found";
        }

        $this->set([
            "status" => $status,
            "message" => $message,
            "data" => $barbero
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Obtener Barbero por email api
    public function obtenerBarberoPorEmail()
    {
        $this->request->allowMethod(["get"]);

        $email = $this->request->getParam("email");

        // Barbero check
        $barbero = $this->Barbero->find()->where([
            "email" => $email
        ])->first();

        if (!empty($barbero)) {
            // success response
            $status = true;
            $message = "Barbero found";
        } else {
            // error response
            $status = false;
            $message = "Barbero not found";
        }

        $this->set([
            "status" => $status,
            "message" => $message,
            "data" => $barbero
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    //Obtener Barbero por v api
    public function obtenerBarberoPorUsuario()
    {
        $this->request->allowMethod(["get"]);

        $usuario = $this->request->getParam("usuario");

        // Barbero check
        $barbero = $this->Barbero->find()->where([
            "usuario" => $usuario
        ])->first();

        if (!empty($barbero)) {
            // success response
            $status = true;
            $message = "Barbero found";
        } else {
            // error response
            $status = false;
            $message = "Barbero not found";
        }

        $this->set([
            "status" => $status,
            "message" => $message,
            "data" => $barbero
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }
    
}