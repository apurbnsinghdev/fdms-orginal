<?php
namespace App\Repositories\Models;

use App\Brand;
use App\Repositories\Repository;
use App\Repositories\Traits\BrandWiseDF;
use DB;
use Illuminate\Database\Eloquent\Model;

class BrandRepository extends Repository {

    use BrandWiseDF;
    // model property on class instances
    //protected $model;

    // Constructor to bind model to repo
    public function __construct() {
        $brand = new Brand;
        parent::__construct($brand);
    }

    // Get all instances of model
    public function all() {
        return $this->model->all();
    }

    // Get all brands cross join with sizes
    public function getBrandSizes($brandIds = [], $sizeIds = []) {
        $brands = DB::table('brands')
            ->crossJoin('sizes')
            ->select('brands.id as brand_id', 'brands.short_code as brand_code',
                'sizes.id as size_id', 'sizes.name as size_name')
            ->orderBy('brands.id')
            ->orderBy('sizes.id');

        if ($brandIds) {
            $brands->whereIn('brands.id', $brandIds);
        }

        if ($sizeIds) {
            $brands->whereIn('sizes.id', $sizeIds);
        }

        return $brands->get();
    }

}
