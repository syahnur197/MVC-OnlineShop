<?php

namespace App\Models;

use App\Entities\Category;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table         = 'categories';
    protected $primaryKey    = 'id';
    protected $returnType    = Category::class;
    protected $useTimestamps = false;
    protected $allowedFields = ['name', 'parent_id'];

    protected $validationRules = [
        'name'      => 'trim|required|min_length[5]|max_length[20]|is_unique[categories.name]',
        'parent_id' => 'permit_empty|is_natural',
    ];

    protected $validationMessages = [
        'name' => ['is_unique' => 'A category with this name already exists.'],
    ];

    public function rulesForUpdate(int $categoryId): array
    {
        return [
            'name'      => "trim|required|min_length[5]|max_length[20]|is_unique[categories.name,id,{$categoryId}]",
            'parent_id' => 'permit_empty|is_natural',
        ];
    }

    /** Top level categories, the ones with no parent. */
    public function topLevel(): array
    {
        return $this->where('parent_id', 0)->orderBy('name', 'ASC')->findAll();
    }

    public function childrenOf(int $categoryId): array
    {
        return $this->where('parent_id', $categoryId)->orderBy('name', 'ASC')->findAll();
    }

    /** The shop sidebar: every top level category with its children attached. */
    public function tree(): array
    {
        $parents = $this->topLevel();

        foreach ($parents as $parent) {
            $parent->children = $this->childrenOf($parent->id);
        }

        return $parents;
    }

    /**
     * Every category with its parent's name and its product count, for the admin
     * listing. Built on the connection rather than the model because the self join
     * needs aliases the model's shared builder cannot carry.
     */
    public function withParentAndProductCount(): array
    {
        return $this->db->table('categories AS c')
            ->select('c.id, c.name, c.parent_id')
            ->select('parent.name AS parent_name')
            ->select('COUNT(products.id) AS product_count')
            ->join('categories AS parent', 'parent.id = c.parent_id', 'left')
            ->join('products', 'products.category_id = c.id', 'left')
            ->groupBy('c.id')
            ->orderBy('c.parent_id', 'ASC')
            ->orderBy('c.name', 'ASC')
            ->get()
            ->getResult();
    }
}
