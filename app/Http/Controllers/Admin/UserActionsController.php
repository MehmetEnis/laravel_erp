<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserActions\UserActionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserActionsRequest;
use App\Http\Requests\Admin\UpdateUserActionsRequest;

class UserActionsController extends Controller
{

    /**
     * The model repo
     *
     * @var ClientRepository
     */
    protected $useraction = null;

    /**
     * Create a new controller instance and binds Repo
     *
     * @return void
     */
    public function __construct(UserActionRepository $useraction)
    {
        $this->useraction =  $useraction;
    }

    /**
     * Display a listing of UserAction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_action_access')) {
            return abort(401);
        }
        $user_actions = $this->useraction->all();
        return view('admin.user_actions.index', compact('user_actions'));
    }
}
