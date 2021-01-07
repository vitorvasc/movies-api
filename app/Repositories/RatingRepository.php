<?php

namespace App\Repositories;

use App\Models\Rating;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class RatingRepository {
    /**
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function find_by_id(string $id)
    {
        $rating = Rating::where('id', $id)->with('movie')->first();

        if (!$rating) {
            throw new Exception('Avaliação não encontrada.');
        }

        return $rating;
    }

    /**
     * @return Rating[]|Collection
     */
    public function find_all()
    {
        return Rating::all();
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
            $rating = $this->find_by_id($id);
            $rating->update($data);
            return $rating->fresh();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function insert(array $data)
    {
        $rating = Rating::create($data);

        if (!$rating) {
            throw new Exception('Ocorreu um erro ao tentar inserir o registro.');
        }

        return $rating;
    }

    /**
     * @param string $id
     * @return bool
     * @throws Exception
     */
    public function delete(string $id): bool
    {
        try {
            $rating = $this->find_by_id($id);
            return $rating->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
