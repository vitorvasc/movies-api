<?php

namespace App\Repositories;

use App\Models\Person;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class PersonRepository
{
    /**
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function find_by_id(string $id)
    {
        $person = Person::where('id', $id)->first();

        if (!$person) {
            throw new Exception('Pessoa não encontrada.', 404);
        }

        return $person;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws Exception
     */
    public function find_by_name(string $name)
    {
        $person = Person::where('name', $name)->first();

        if (!$person) {
            throw new Exception('Pessoa não encontrada.', 404);
        }

        return $person;
    }

    /**
     * @return Person[]|Collection
     */
    public function find_all()
    {
        return Person::all();
    }

    /**
     * @param string $id
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function update_by_id(string $id, array $data)
    {
        try {
            $person = $this->find_by_id($id);
            $person->update($data);
            return $person->fresh();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function insert(array $data)
    {
        $person = Person::create($data);

        if (!$person) {
            throw new Exception('Ocorreu um erro ao tentar inserir o registro.', 400);
        }

        return $person;
    }

    /**
     * @param string $id
     * @return bool
     * @throws Exception
     */
    public function delete(string $id): bool
    {
        try {
            $person = $this->find_by_id($id);
            return $person->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
