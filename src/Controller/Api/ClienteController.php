<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Cake\Mailer\TransportFactory;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Exception;

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

        function base64_to_jpeg($base64_string, $output_file)
        {
            // open the output file for writing
            $ifp = fopen($output_file, 'wb');

            // split the string on commas
            // $data[ 0 ] == "data:image/png;base64"
            // $data[ 1 ] == <actual base64 string>
            // $data = explode(',', $base64_string);

            // we could add validation here with ensuring count( $data ) > 1
            fwrite($ifp, base64_decode($base64_string));

            // clean up the file resource
            fclose($ifp);

            return $output_file;
        }



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

            if (!empty($formData['imagen_perfil'])) {
                $imagen_perfil_base64 = $formData['imagen_perfil'];

                base64_to_jpeg($imagen_perfil_base64, WWW_ROOT . 'img' . DS . 'perfil' . $formData['usuario'] . '.jpeg');

                $formData['imagen_perfil'] = $formData['usuario'] . '.jpeg';
            } else {
                $formData['imagen_perfil'] = 'default.jpeg';
            }
            // $formData['imagen_perfil'] = $formData['usuario'] . '.jpeg';

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
            $this->Authentication->logout(); // cerrar sesi??n luego de cargar exitosamente los datos del usuario autenticado
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

    public function olvidarContrasena()
    {
        $this->request->allowMethod(["post"]);
        if ($this->request->is('post')) {
            //Obtenemos el email del usuario
            $myEmail = $this->request->getData('email');
            //Obtenemos el usuario que tiene ese email
            $cliente = $this->Cliente->findByEmail($myEmail)->first();
            //Creamos un Token para el usuario
            $myToken = Security::hash(Security::randomBytes(32), 'sha256', true);
            //Seteamos el token en el usuario
            $cliente->token = $myToken;

            //Creamos el correo
            $mailer = new Mailer();
            //Seteamos la configuracion al correo
            $mailer->setTransport('gmail'); //Para enviar por Gmail y no usar el entorno de pruebas de mailtrap

            //Creamos el mensaje
            $mailer
                ->setEmailFormat('html')
                ->setTo($myEmail)
                ->setFrom('tapelau@tapelau.com.uy')
                ->setSubject('Restablecer contrase??a');
            try {
                $this->Cliente->save($cliente);
                $mailer->deliver('Hola ' . $cliente->nombre . ', para restablecersdadasd su contrase??a haga click en el siguiente enlace: <br><a href="http://192.168.56.1/barber_appPHP/cliente/restablecerContrasena/' . $cliente->token . '">Restablecer contrase??a</a>');
                $status = true;
                $message = "Cliente logged in";
                $data = $cliente;
            } catch (Exception $e) {
                $status = false;
                $message = "Ha ocurrido un error al enviar un correo a " . $myEmail;
                $data = null;
            }

            $this->set([
                "status" => $status,
                "message" => $message,
                "data" => $data
            ]);

            $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
        }
    }

    public function restablecerContrasena()
    {
        $this->request->allowMethod(["post"]);
        if ($this->request->is('post')) {
            $token = $this->request->getData("token");
            $newPassword =  $this->request->getData("password");
            $cliente = $this->Cliente->findByToken($token)->first();
            $cliente->clave = $newPassword;

            try {
                $this->Cliente->save($cliente);
                $status = true;
                $message = "Contrase??a modificada con ??xito.";
                $data = $cliente;
            } catch (Exception $e) {
                $status = false;
                $message = "No se ha podidio modificar la contrase??a";
                $data = null;
            }

            $this->set([
                "status" => $status,
                "message" => $message,
                "data" => $data
            ]);

            $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
        }
    }

    public function listarBarberias(){
        $this->request->allowMethod(["get"]);

        $barberias = $this->loadModel('Barbershop')->find('all')->toArray();

        $this->set([
            "status" => true,
            "message" => "Lista Barber??as",
            "data" => $barberias
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    public function obtenerReservasCliente(){
        $this->request->allowMethod(["get"]);

        $cliente_id = $this->request->getParam("id");
        $reservas = $this->loadModel('Reserva')->find('all')->where(['cliente_id' => $cliente_id])->toArray();

        $cortes_reserva = [];
        $barberos_reserva = [];
        $listaReserva = [];
        foreach ($reservas as $reserva) {
            array_push($cortes_reserva, $this->Cliente->Reserva->Corte->findById($reserva['corte_id'])->first());
        }
        foreach ($cortes_reserva as $corte) {
            array_push($barberos_reserva, $this->Cliente->Reserva->Corte->Barbero->findById($corte['barbero_id'])->first());
        }

        foreach ($reservas as $reserva) {
            $barberoId= $this->Cliente->Reserva->Corte->findById($reserva['corte_id'])->first()->barbero_id;
            $reservax['corte'] = $this->Cliente->Reserva->Corte->findById($reserva['corte_id'])->first()->nombre;
            $reservax['barbero'] = $this->loadModel('Barbero')->findById($barberoId)->first()->nombre;
            $reservax['fecha_corte'] = $reserva->fecha_corte;
            $reservax['hora_comienzo_corte'] = $reserva->hora_comienzo_corte;
            $reservax['fecha_reservada'] = $reserva->fecha_reserva;
            array_push($listaReserva, $reservax);
        }

        $this->set([
            "status" => true,
            "message" => "Lista Reservas",
            "data" => $listaReserva
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    public function obtenerBarberia(){
        $this->request->allowMethod(["get"]);

        $barberia_id = $this->request->getParam("id");

        //$barberia = $this->loadModel('Barbershop')->findById($barberia_id)->first();

        $barberia = $this->loadModel('Barbershop')->get($barberia_id, [
            'contain' => ['Barbero'],
        ]);

        $this->set([
            "status" => true,
            "message" => "Lista Barber??as",
            "data" => $barberia
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }
}
