<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'menus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'menu_name', 'parent_id', 'page_id', 'url', 
        'position', 'status', 'menu_type', 'theme_location', 
        'created_at', 'updated_at'
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
     * Fetch menus by type.
     */
    public function getMenusByType($type)
    {
        return $this->where('menu_type', $type)
                    ->where('status', 'Active')
                    ->orderBy('position', 'ASC')
                    ->findAll();
    }

    /**
     * Fetch menus by theme location.
     */
    public function getMenusByThemeLocation($location)
    {
        return $this->where('theme_location', $location)
                    ->where('status', 'Active')
                    ->orderBy('position', 'ASC')
                    ->findAll();
    }

    /**
     * Fetch hierarchical menus.
     */
    public function getHierarchicalMenu($location)
    {
        $menus = $this->getMenusByThemeLocation($location);
        return $this->buildHierarchy($menus);
    }

    /**
     * Build hierarchical menu tree.
     */
    private function buildHierarchy($menus, $parentId = null)
    {
        $tree = [];
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $parentId) {
                $children = $this->buildHierarchy($menus, $menu['id']);
                if ($children) {
                    $menu['children'] = $children;
                }
                $tree[] = $menu;
            }
        }
        return $tree;
    }

}
