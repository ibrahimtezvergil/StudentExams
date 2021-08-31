<?php


namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ReflectionClass;

/**
 * Trait ModelOperationTrait
 * @package App\Http\Traits
 */
trait ModelOperationTrait
{
    /**
     * @param $model
     * @param null $relations
     * @return string
     */
    public function getModels($model, $relations = null)
    {

        if (empty($model)) {
            throw new ModelNotFoundException();
        }
        try {
            $model = (new ReflectionClass($model))->newInstance();
            return $model->with($relations)->get();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
