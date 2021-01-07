<?php

namespace App\Repositories;

use App\Models\Person;
use Exception;

class PersonRepository {
    /**
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function find_by_id(string $id) {
        $person = Person::where('id', $id)->first();

        if(!$person) {
            throw new Exception('Pessoa '. $id .' não encontrada.');
        }

        return $person;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws Exception
     */
    public function find_by_name(string $name) {
        $person = Person::where('name', $name)->first();

        if(!$person) {
            throw new Exception('Pessoa '. $name .' não encontrada.');
        }

        return $person;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function insert(array $data) {
        $person = Person::create($data);

        if(!$person) {
            throw new Exception('Ocorreu um erro ao tentar inserir o registro.');
        }

        return $person;
    }
}
