<?php

interface DataServiceInterface {
    public function request(string $url, string $method, array $options = null): void;
}

class XMLHttpService extends XMLHTTPRequestService implements DataServiceInterface {

    public function request(string $url, string $method, array $options = null): void
    {
        //
    }
}

class Http {

    public function __construct(
        public DataServiceInterface $service
    ) {
    }

    public function get(string $url, array $options): void {
        $this->service->request($url, 'GET', $options);
    }

    public function post(string $url): void {
        $this->service->request($url, 'GET');
    }
}
