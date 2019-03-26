<?php

namespace App\Observers;

use Auth;
use App\UserAction;

class UserActionsObserver
{
    public function saved($model)
    {
        if ($model->wasRecentlyCreated === true) {
            $action = 'Created';
        } else {
            $action = 'Updated';
        }

        if (Auth::check()) {
            UserAction::create([
                'user_id'      => Auth::user()->id,
                'action'       => $action,
                'action_model' => $model->getTable(),
                'action_id'    => $model->id
            ]);
        }

    }


    public function deleting($model)
    {
        if (Auth::check()) {
            UserAction::create([
                'user_id'      => Auth::user()->id,
                'action'       => 'Deleted',
                'action_model' => $model->getTable(),
                'action_id'    => $model->id
            ]);
        }
    }
}