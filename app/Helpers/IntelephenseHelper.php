<?php

namespace Illuminate\Contracts\View;

use Illuminate\Contracts\Support\Renderable;

interface View extends Renderable
{
    /** @return static */
    public function layout();

    /**
     * @param array $data
     * @return static
     *
     */
    public function layoutData();
}
