<?php

namespace App\Traits;

trait WithAlerts
{
    public $success = null;
    public $error = null;
    public $warning = null;

    public function resetSuccess()
    {
        $this->reset('success');
    }

    public function resetError()
    {
        $this->reset('error');
    }

    public function resetWarning()
    {
        $this->reset('warning');
    }
}
