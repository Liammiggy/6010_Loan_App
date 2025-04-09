<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Exception;

abstract class AbstractService
{
    
    protected string $model;
    protected bool $showWithRelations = false;
    protected array $customFilters = [];

    protected array $relations = [];

    public function model(): Model
    {
        if (is_string($this->model)) {
            return app($this->model);
        }

        throw new \Exception("Model is not defined or invalid in the service.");
    } 

    public function all(array $filters = []): Builder
    {
        $query = $this->model()->newQuery();

        if (!empty($this->customFilters)) {
            $query->where($this->customFilters);
        }

        if ($this->showWithRelations) {
            $query->with($this->relations);
        }

        if (!empty($filters)) {
            $query->where($filters);
        }

        return $query;
    }

    protected function relations(array $relations = []): void
    {
        $this->relations = $relations;
    }

    public function find($id)
    {
        $query = $this->model()->newQuery();

        if ($this->showWithRelations) {
            $query->with($this->relations);
        }

        return $query->find($id);
    }
}
