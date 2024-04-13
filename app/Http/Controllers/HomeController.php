<?php

namespace App\Http\Controllers;

use App\Interfaces\HomeInterface;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(
        private HomeInterface $home
    ) {
        $this->home = $home;
    }

    /**
     * display list of homes
     *
     * @return void
     */
    public function index(): View
    {
        ['results' => $homes, 'pagination_size' => $pagination_size] = $this->home->indexHomeService();

        return view('home.index', compact('homes', 'pagination_size'));
    }

    /**
     * display create form
     *
     * @return void
     */
    public function create(): View
    {
        return view('home.create');
    }

    /**
     * display pagination of homes
     *
     * @param Request $request
     * @return View
     */
    public function pagination(Request $request): View
    {

        ['results' => $homes, 'pagination_size' => $pagination_size] = $this->home->paginationHomeService($request->toArray());

        return view('home.index', compact('homes', 'pagination_size'));
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

        ['status' => $status, 'message' => $message] = $this->home->createHomeService($request->toArray());

        if ($status == 500) {
            return view('error')->with('error', $message);
        }

        return redirect('/home')->with('success', $message);
    }

    /**
     * display editing home
     *
     * @param Home $home
     * @return void
     */
    public function edit(Home $home): View
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
        ['status' => $status, 'message' => $message] = $this->home->updateHomeService($request->toArray(), $home->id);

        if ($status == 500) {
            return view('error')->with('error', $message);
        }

        return redirect('/home')->with('success', $message);
    }

    /**
     * delete home
     *
     * @param Home $home
     * @return void
     */
    public function destroy(Home $home)
    {
        ['status' => $status, 'message' => $message] = $this->home->deleteHomeService($home->id);

        if ($status == 500) {
            return view('error')->with('error', $message);
        }

        return redirect('/home')->with('success', $message);
    }
}
