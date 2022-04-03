<?php
namespace App\Models;
use CodeIgniter\Model;

class ApiModel
{
    protected $table = 'tbl_users';
    // .. other member variables
    private $db;


    public function insert_data($data = array())
    {
      
        $curl = \Config\Services::curlrequest();
        $posts_data = $curl->request("post", "https://6172007661ed900017c405dc.mockapi.io/users", [
			"headers" => [
				"Accept" => "application/json"
            ],
            "form_params" => [
                'name' => $data['name'],
                'avatar' => $data['avatar'],
            ],
		]);

        
		return $posts_data->getBody();
    }

    public function get_all_data()
    {
        $curl = \Config\Services::curlrequest();
        $posts_data = $curl->request("get", "https://6172007661ed900017c405dc.mockapi.io/users", [
			"headers" => [
				"Accept" => "application/json"
			]
		]);
		return $posts_data->getBody();
    }

}