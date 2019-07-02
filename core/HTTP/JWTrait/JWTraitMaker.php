<?php

namespace App\Core\HTTP\JWTrait;
use Firebase\JWT\JWT;

trait JWTraitMaker{

    private $jwt;

    public function encode(array $toEncode){
        $iat = time();
        $nbf = $iat + 5;
        $exp = $nbf + (3600*2);
        
        $token_payload = [
            'iss' => 'manouche',
            'sub' => '1',
            "iat" => $iat,
            "nbf" => $nbf,
            "exp" => $exp,
            "data" => [
                "userId" => $toEncode['id'],
                "userName" => $toEncode['name'],
                "role" => $toEncode['role'],
            ]
          ];
          // This is your client secret
          $key = env("token-secret");
          // This is your id token
          $jwt = JWT::encode($token_payload, base64_decode(strtr($key, '-_', '+/')), 'HS256');
          print "JWT:\n";
          dd($jwt);
          
    }

    /**
     * Makes data array
     *
     * @param array $array
     * @return array
     */
}