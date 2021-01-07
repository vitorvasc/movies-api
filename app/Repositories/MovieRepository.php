<?php

namespace App\Repositories;

use App\Models\Movie;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class MovieRepository
{
    /**
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function find_by_id(string $id)
    {
        $movie = Movie::where('id', $id)->with('ratings')->first()
            ->get_people_roles()
            ->get_ratings_average();

        if (!$movie) {
            throw new Exception('Filme não encontrado.');
        }

        return $movie;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws Exception
     */
    public function find_by_name(string $name)
    {
        $movie = Movie::where('name', $name)->first();

        if (!$movie) {
            throw new Exception('Filme não encontrado.');
        }

        return $movie;
    }

    /**
     * @return Builder[]|Collection
     */
    public function find_all()
    {
        return Movie::all();
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
            $movie = $this->find_by_id($id);
            $movie->update($data);
            return $movie->fresh();
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
        $movie = Movie::create($data);

        if (!$movie) {
            throw new Exception('Ocorreu um erro ao tentar inserir o registro.');
        }

        return $movie;
    }

    /**
     * @param string $id
     * @return bool
     * @throws Exception
     */
    public function delete(string $id): bool
    {
        try {
            $movie = $this->find_by_id($id);
            return $movie->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
