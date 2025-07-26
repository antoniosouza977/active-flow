<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EntityManager
{
    private ?Model $entity = null;

    private ?Builder $builder = null;

    const PAGE_SIZE = 10;

    public function setModel(mixed $model): static
    {
        if (is_string($model)) {
            $this->entity = new $model;

            return $this;
        }

        if (! $model instanceof Model) {
            throw new \InvalidArgumentException('Invalid model');
        }

        $this->entity = $model;

        return $this;
    }

    public function setBuilder(Builder $builder): static
    {
        $this->builder = $builder;

        return $this;
    }

    private function getEntity(): Model
    {
        if (! $this->entity instanceof Model) {
            throw new \RuntimeException('Model not set');
        }

        return $this->entity;
    }

    public function create(array $data)
    {
        return $this->getEntity()->newQuery()->create($data);
    }

    public function update(array $data): bool
    {
        return $this->getEntity()->newQuery()->update($data);
    }

    public function destroy(): void
    {
        $this->getEntity()->delete();
    }

    public function getPage(): LengthAwarePaginator
    {
        if ($this->builder instanceof Builder) {
            return $this->builder->paginate(self::PAGE_SIZE);
        }

        return $this->getEntity()->newQuery()->paginate(self::PAGE_SIZE);
    }
}
