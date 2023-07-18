<?php

class SomeObject {

    public function __construct(
        public string $name
    ) {
    }

    public function getHandler(): string {
        return 'handle_' . $this->name;
    }
}

class SomeObjectsHandler {
    public function __construct() {
    }

    /**
     * @param array $objects
     * @return array<SomeObject>
     */
    public function handleObjects(array $objects): array {
        return array_map(function (SomeObject $object): string {
            return $object->getHandler();
        }, $objects);
    }
}

$objects = [
    new SomeObject('object_1'),
    new SomeObject('object_2')
];

$soh = new SomeObjectsHandler();
$soh->handleObjects($objects);