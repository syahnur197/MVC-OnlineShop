<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int                   $id
 * @property string                $name
 * @property int                   $parent_id  0 when this is a top level category.
 * @property list<Category>        $children   Only filled in by CategoryModel::tree().
 */
class Category extends Entity
{
    protected $casts = [
        'id'        => 'int',
        'parent_id' => 'int',
    ];

    /** @var list<Category> */
    protected $children = [];

    public function isTopLevel(): bool
    {
        return (int) $this->attributes['parent_id'] === 0;
    }

    /** @param list<Category> $children */
    public function setChildren(array $children): static
    {
        $this->children = $children;

        return $this;
    }

    /** @return list<Category> */
    public function getChildren(): array
    {
        return $this->children;
    }
}
