<?php

namespace App\Services;

use App\Interfaces\HomeInterface;
use App\Interfaces\PropertyInterface;
use App\Models\Home;
use App\Models\Property;
use App\Traits\ReturnCollectionTrait;
use App\Traits\ReturnModelTrait;
use App\Traits\ReturnPaginatorTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class PropertyService implements PropertyInterface
{
    public $return_values = [];
    use ReturnCollectionTrait, ReturnModelTrait, ReturnPaginatorTrait;
    public function indexPropertyService(): array
    {
        $pagination_size = 10;
        $properties = Property::paginate($pagination_size);
        return $this->returnPaginator(200, 'success', $properties, $pagination_size);
    }

    public function createPropertyService(array $request): array
    {
        try {
            DB::beginTransaction();

            $properties = Property::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'home_id' => $request['home_id']
            ]);

            $this->return_values = $this->returnModel(201, 'Successfully Created Property', $properties);
        } catch (Exception $e) {
            DB::rollBack();
            $this->return_values = $this->returnModel(500, $e->getMessage());
        }
        DB::commit();

        return $this->return_values;
    }

    public function updatePropertyService(array $request, int $property_id): array
    {
        try {
            DB::beginTransaction();

            $properties = Property::findOrFail($property_id);

            $properties = tap($properties)->update([
                'name' => $request['name'],
                'description' => $request['description'],
                'home_id' => $request['home_id']
            ]);

            $this->return_values = $this->returnModel(200, 'Successfully Updated Property', $properties);
        } catch (Exception $e) {
            DB::rollBack();
            $this->return_values = $this->returnModel(500, $e->getMessage());
        }
        DB::commit();

        return $this->return_values;
    }

    public function deletePropertyService(int $property_id): array
    {
        try {
            DB::beginTransaction();

            $properties = Property::findOrFail($property_id);

            $properties->delete();

            $this->return_values = $this->returnModel(200, 'Successfully Deleted Property');
        } catch (Exception $e) {
            DB::rollBack();
            $this->return_values = $this->returnModel(500, $e->getMessage());
        }
        DB::commit();

        return $this->return_values;
    }
}