<?php


namespace App\Services;

use App\Interfaces\HomeInterface;
use App\Models\Home;
use App\Traits\ReturnCollectionTrait;
use App\Traits\ReturnModelTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class HomeService implements HomeInterface
{
    public $return_values = [];
    use ReturnCollectionTrait, ReturnModelTrait;

    public function indexHomeService(): array
    {
        $homes = Home::all();

        return $this->returnCollection(200, 'success',$homes);
    }
    public function showHomeService(): array
    {
        return $this->return_values;
    }
    public function createHomeService(array $request): array
    {
        try {
            DB::beginTransaction();

            $home = Home::create([
                'name' => $request['name'],
                'description' => $request['description']
            ]);

            $this->return_values =  $this->returnModel(201, 'success created', $home);
        } catch (Exception $e) {
            DB::rollBack();

            $this->return_values = $this->returnModel(500, $e->getMessage());
        }
        DB::commit();
        
        return $this->return_values;
    }
    public function updateHomeService(array $request, int $home_id): array
    {
        try {
            DB::beginTransaction();

            $home = Home::findOrFail($home_id);

            $home = tap($home)->update([
                'name' => $request['name'],
                'description' => $request['description']
            ]);

            $this->return_values =  $this->returnModel(200, 'success updated', $home);
        } catch (Exception $e) {
            DB::rollBack();

            $this->return_values = $this->returnModel(500, $e->getMessage());
        }
        DB::commit();

        return $this->return_values;
    }
    public function deleteHomeService(int $home_id): array
    {
        try {
            DB::beginTransaction();

            $home = Home::findOrFail($home_id);

            $home->delete();

            $this->return_values =  $this->returnModel(200, 'success deleted');
        } catch (Exception $e) {
            DB::rollBack();

            $this->return_values = $this->returnModel(500, $e->getMessage());
        }
        DB::commit();

        return $this->return_values;
    }
}
