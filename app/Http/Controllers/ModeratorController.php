<?php

namespace App\Http\Controllers;

use App\User;
use Core\Services\ModeratorService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ModeratorController extends Controller
{
    use RegistersUsers;

    private $moderatorService;

    /**
     * Create a new controller instance.
     * @param ModeratorService $moderatorService
     */
    public function __construct(ModeratorService $moderatorService)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->moderatorService = $moderatorService;
    }

    /**
     * Display a listing of the moderators.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moderators = $this->moderatorService->listModerators();

        return view('moderators.index', compact('moderators'));
    }

    /**
     * Show the form for creating a new moderator.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('moderators.create');
    }

    /**
     * Store a newly created moderator in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->moderatorService->createModerator($request->all())));

        Session::flash('message', 'Successfully created the user!');
        return redirect(route('moderator.index'));
    }

    /**
     * Get a validator for an incoming creation request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Display the specified moderator.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified moderator.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $moderator = User::find($id);

        return view('moderators.edit', compact('moderator'));
    }

    /**
     * Update the specified moderator in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->editValidator($id, $request->all())->validate();

        if ($request->get('password')) {
            $data = $request->only(['name', 'email', 'password']);
        } else {
            $data = $request->only(['name', 'email']);
        }

        $this->moderatorService->updateModerator($id, $data);

        Session::flash('message', 'Successfully updated the user!');

        return redirect(route('moderator.index'));
    }

    /**
     * Get a validator for an incoming creation request.
     *
     * @param $id
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     * @internal param $email
     */
    protected function editValidator($id, array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'confirmed',
        ]);
    }

    /**
     * Remove the specified moderator from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $this->moderatorService->deleteModerators($id);

        // redirect
        Session::flash('message', 'Successfully deleted the user!');
        return redirect(route('moderator.index'));
    }
}
