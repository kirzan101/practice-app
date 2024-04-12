<?php


namespace App\Services;

use App\Interfaces\HomeInterface;
use App\Models\Home;
use Exception;
use Illuminate\Support\Facades\DB;

class HomeService implements HomeInterface
{
    public $return_values = [];

    public function indexHomeService(): array
    {
        $homes = Home::all();

        $this->return_values = [
            'results' => $homes,
            'status' => 200
        ];

        return $this->return_values;
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
        } catch (Exception $e) {
            DB::rollBack();

            $this->return_values = [
                'result' => null,
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
        DB::commit();

        $this->return_values = [
            'result' => $home,
            'status' => 200,
            'message' => 'Success created'
        ];

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
        } catch (Exception $e) {
            DB::rollBack();

            $this->return_values = [
                'result' => null,
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
        DB::commit();

        $this->return_values = [
            'result' => $home,
            'status' => 200,
            'message' => 'Success updated'
        ];

        return $this->return_values;
    }
    public function deleteHomeService(int $home_id): array
    {
        try {
            DB::beginTransaction();

            $home = Home::findOrFail($home_id);

            $home->delete();

        } catch (Exception $e) {
            DB::rollBack();

            $this->return_values = [
                'result' => null,
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
        DB::commit();

        $this->return_values = [
            'result' => $home,
            'status' => 200,
            'message' => 'Success deleted'
        ];

        return $this->return_values;
    }
}
