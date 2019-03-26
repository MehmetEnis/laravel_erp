<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Repositories\User\UserRepository;
use App\Repositories\UserActions\UserActionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class UsersController extends Controller
{

    /**
     * The model repo
     *
     * @var UserRepository
     */
    protected $user = null;

    /**
     * The model useractions repo
     *
     * @var UserActionRepository
     */
    protected $useraction = null;

    /**
     * Create a new controller instance and binds Repo
     *
     * @return void
     */
    public function __construct(UserRepository $user, UserActionRepository $useraction)
    {
        $this->user =  $user;
        $this->useraction =  $useraction;
    }

    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_access')) {
            return abort(401);
        }
        $users = $this->user->all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        $roles = Role::get()->pluck('title', 'id')->prepend(trans('erp.please_select'), '');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        $this->user->create($request->all());
        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $roles = Role::get()->pluck('title', 'id')->prepend(trans('erp.please_select'), '');
        $user = $this->user->show($id);
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $this->user->update($request->all(), $id);
        return redirect()->route('admin.users.index');
    }


    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_view')) {
            return abort(401);
        }
        $user_actions = $this->useraction->actions('user_id', $id);
        $user = $this->user->show($id);
        return view('admin.users.show', compact('user', 'user_actions'));
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        $this->user->delete($id);
        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = $this->user->in('id', $request->input('ids'));

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
