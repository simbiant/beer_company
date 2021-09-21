<?php

namespace App\Observers;

use App\Models\Vacancy;

class VacancyObserver
{
    /**
     *
     * @param Vacancy $survey
     * @return void
     */

    public function updated(Vacancy $vacancy)
    {
        if (old($vacancy->availability) === 0 && $vacancy->availability === 1) {
            dispatch(new Notification($vacancy->id));
        }
    }
}
