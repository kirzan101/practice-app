<?php


namespace App\Services;

use App\Interfaces\HomeInterface;
use App\Models\Home;
use App\Traits\ReturnCollectionTrait;
use App\Traits\ReturnModelTrait;
use App\Traits\ReturnPaginatorTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class HomeService implements HomeInterface
{
    public $return_values = [];
    use ReturnCollectionTrait, ReturnModelTrait, ReturnPaginatorTrait;

    public function indexHomeService(): array
    {
        $pagination_size = 10;
        $homes = Home::paginate($pagination_size);

        return $this->returnPaginator(200, 'success', $homes, $pagination_size);
    }

    public function paginationHomeService(array $request): array
    {
        $pagination_size = $request['pagination'];

        $homes = Home::paginate($pagination_size);

        return $this->returnPaginator(200, 'success', $homes, $pagination_size);
    }

    public function createHomeService(array $request): array
    {
        try {
            DB::beginTransaction();

            $home = Home::create([
                'name' => $request['name'],
                'description' => $request['description']
            ]);

            $this->return_values = $this->returnModel(201, 'Created Home Successfully', $home);
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

            $this->return_values = $this->returnModel(200, 'Updated Home Successfully', $home);
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

            $this->return_values = $this->returnModel(200, 'Deleted Home Successfully');
        } catch (Exception $e) {
            DB::rollBack();

            $this->return_values = $this->returnModel(500, $e->getMessage());
        }
        DB::commit();

        return $this->return_values;
    }
}
