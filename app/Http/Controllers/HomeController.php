<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * display list of homes
     *
     * @return void
     */
    public function index()
    {
        $homes = Home::all();

        return view('home.index', compact('homes'));
    }

    /**
     * display create form
     *
     * @return void
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * save home to database
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        // Transaction
        try {
            DB::beginTransaction();

            Home::create([
                'name' => $request->name,
                'description' => $request->description
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
        }
        DB::commit();

        return redirect('/home')->with('success', 'success');
    }

    /**
     * display editing home
     *
     * @param Home $home
     * @return void
     */
    public function edit(Home $home)
    {
        return view('home.edit', compact('home'));
    }

    /**
     * updtes to database
     *
     * @param Home $home
     * @param Request $request
     * @return void
     */
    public function update(Home $home, Request $request)
    {
        $home = tap($home)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect('/home')->with('success', 'success');
    }

    /**
     * delete home
     *
     * @param Home $home
     * @return void
     */
    public function destroy(Home $home)
    {
        $home->delete();

        return redirect('/home')->with('success', 'success');
    }
}
