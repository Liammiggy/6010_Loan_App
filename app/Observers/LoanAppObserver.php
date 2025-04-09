<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class LoanAppObserver
{
    
    public function created(Model $model)
    {
        $this->logChange($model, 'created', null, $model->getAttributes());
    }

    public function updated(Model $model)
    {
        $oldData = $model->getOriginal(); 
        $newData = $model->getAttributes(); 
        
        $this->logChange($model, 'updated', $oldData, $newData);
    }

    public function deleting(Model $model)
    {
        $oldData = $model->getOriginal(); 
        $newData = $model->getAttributes();

        $this->logChange($model, 'deleted', $oldData, $newData);
    }

    protected function logChange(Model $model, string $action, ?array $oldData, ?array $newData)
    {
        try {
            $userId = Auth::check() ? Auth::id() : null;

            ActivityLog::create([
                'model' => get_class($model),
                'model_id' => $model->id,
                'action' => $action,
                'old_data' => !empty($oldData) ? json_encode($oldData) : null,
                'new_data' => !empty($newData) ? json_encode($newData) : null,
                'user_id' => $userId,
            ]);

        } catch (\Throwable $th) {
            Log::error('Error edit log ' . $th->getMessage() . "\n" . $th->getTraceAsString());
            abort(500);
        }
    }
    
}
