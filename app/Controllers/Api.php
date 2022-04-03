<?php

namespace App\Controllers;
use App\Models\ApiModel;

class Api extends BaseController
{

    //$apiModel = new ApiModel();

    public function index()
    {
        echo "Bienvenido a la API de usuarios.";
    }

    public function getData() {

        $ApiModel = new ApiModel();
        $result = $ApiModel->get_all_data();       
        echo $result;
    }

    public function adduser()
    {
            return view('adduser');
    }

    public function postData() {

        $data = array();
        if ( $this->request->getPost('name')!==null){
            $data["name"]= $this->request->getPost('name'); 
          } else {
            $data["name"]= "";
          }
        if ( $this->request->getPost('avatar')!==null){
            $data["avatar"]= $this->request->getPost('avatar'); 
          } else {
            $data["avatar"]= "-----";
          }

      
        $ApiModel = new ApiModel();
        $result = json_decode($ApiModel->insert_data($data));       
        
        // echo "Usuario Registrado, Nombre:".$result->name." ID:".$result->id;
        return redirect()->to('/');
    }
}
