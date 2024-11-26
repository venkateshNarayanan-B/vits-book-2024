<?php

namespace App\Models;

use CodeIgniter\Model;

class PagesModel extends Model
{
    protected $table            = 'pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title', 'slug', 'content', 
        'meta_keywords', 'meta_description', 'status',
        'parent_id', 'created_at', 'updated_at'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

     /**
     * Get all pages with hierarchy
     */
    public function getPagesHierarchy()
    {
        $pages = $this->orderBy('parent_id, title', 'ASC')->findAll();
        return $this->buildHierarchy($pages);
    }

    /**
     * Build hierarchical structure
     */
    private function buildHierarchy($pages, $parentId = null)
    {
        $result = [];
        foreach ($pages as $page) {
            if ($page['parent_id'] == $parentId) {
                $page['children'] = $this->buildHierarchy($pages, $page['id']);
                $result[] = $page;
            }
        }
        return $result;
    }
}
