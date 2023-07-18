<?php

use \GuzzleHttp\Client;
class Concept {

    public function __construct(
        private Client $client,
        private SecretKeyStorage $storage,
    ) {
    }

    public function getUserData(): void {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $storage->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }

}

interface SecretKeyStorage {
    public function getSecretKey(): string;
}

class KeyFromDB implements SecretKeyStorage {

    public function getSecretKey(): string
    {
        return get_from_db();
    }
}

class KeyFromFile implements SecretKeyStorage {

    public function getSecretKey(): string
    {
        return get_from_file();
    }
}

class KeyFromCloud implements SecretKeyStorage {

    public function getSecretKey(): string
    {
        return get_from_cloud();
    }
}

class KeyFromEtc implements SecretKeyStorage {

    public function getSecretKey(): string
    {
        return parse_string_closure(); // парсит подписанный closure с помощью этой зависимости, https://github.com/opis/closure и получает после исполнения какой-то работы, такой себе биткоин на минималках)))
    }
}


$fromDB = new Concept(new Client(), (new KeyFromDB()));
$fromFile = new Concept(new Client(), (new KeyFromFile()));
$fromCloud = new Concept(new Client(), (new KeyFromCloud()));