<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\NotaModel;
use ReallySimpleJWT\Token;


class Api extends BaseController
{
    function __construct()
    {
        $this->notaModel = new NotaModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        return $this->response->setJSON([]);
    }
    public function notas()
    {

        $token = $this->request->getGet('token');
        $secret = config('Database')->token_secret;

        if (Token::validate($token, $secret)) {
            $notas = $this->notaModel->orderBy('updated', 'desc')
                ->findAll();

            return $this->response->setJSON($notas);
        } else  return $this->response->setJSON([]);
    }

    public function addNota()
    {

        $json = $this->request->getJSON();
        $data = [
            'titulo' => $json->titulo,
            'nota' => $json->nota,
            'created' => time(),
            'updated' => time()
        ];

        $nota = $this->notaModel->save($data);
        if (!$nota) return $this->response->setStatusCode(400, 'Error Guardando nota');
        return $this->response->setJSON($data);
    }

    public function nota($id, $token)
    {
        $secret = config('Database')->token_secret;
        if (Token::validate($token, $secret)) {
            if ($id)
                return $this->response->setJSON($this->notaModel->find($id));
        }
    }
    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function updateNota()
    {
        $json = $this->request->getJSON();

        if ($json->id) {
            $secret = config('Database')->token_secret;
            if (Token::validate($json->token, $secret)) {
                $this->notaModel->where('id', $json->id)->set(['nota' => $json->nota, 'updated' => time()])->update();
                return $this->response->setJSON([]);
            }
        } else {
            return $this->response->setStatusCode(400, 'Error Actualizando nota');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function deleteNota($id = null, $token = null)
    {
        $findById = $this->notaModel->find(['id' => $id]);

        if (!$findById) return $this->response->setStatusCode(400, 'Error Guardando nota');
        $secret = config('Database')->token_secret;
        if (Token::validate($token, $secret)) {
            $nota = $this->notaModel->delete($id);
        }
        if (!$nota) return $this->response->setStatusCode(400, 'Error Guardando nota');

        return $this->response->setJSON([]);
    }

    public function login()
    {

        $json = $this->request->getJSON();
        if ($json) {

            $findById = $this->usuarioModel->where(['name' => $json->username, 'password' => $json->password])->first();
            if (!$findById) {
                return $this->response->setStatusCode(403, json_encode(['message' => 'Error Login usuario']));
            } else {
                $userId = 1;
                $secret = config('Database')->token_secret;
                $expiration = time() + 15600;
                $issuer = 'localhost';

                $token = Token::create($userId, $secret, $expiration, $issuer);

                $this->usuarioModel->where('name', $json->username)->set(['token' => $token])->update();

                return $this->response->setJSON(array('token' => $token, 'username' => $json->username));
            }
            //return $this->response->setJSON($response);

        }
    }

    private function checkToken($token)
    {
    }
}
