<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\Audit;

class CompanyObserver
{

    /**
     * Handle the Company "saved" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function saved(Company $company)
    {
        // Determina se é uma criação ou uma atualização
        $action = $company->wasRecentlyCreated ? 'create' : 'update';

        Audit::create([
            'model_type' => Company::class,
            'model_id' => $company->id,
            'action' => $action,
            'user_id' => auth()->id(),
            'changes' => json_encode($company->getChanges()),
        ]);
    }

    /**
     * Handle the Company "created" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function created(Company $company) {}

    /**
     * Handle the Company "updated" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updated(Company $company) {}
    /**
     * Handle the Company "deleted" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function deleted(Company $company)
    {
        Audit::create([
            'model_type' => Company::class,
            'model_id' => $company->id,
            'action' => 'delete',
            'user_id' => auth()->id(),
            'changes' => json_encode($company->getOriginal()),
        ]);
    }
}
