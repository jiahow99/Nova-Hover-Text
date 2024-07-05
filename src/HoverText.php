<?php

namespace Mices\HoverText;

use Laravel\Nova\Contracts\FilterableField;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\FieldFilterable;
use Laravel\Nova\Fields\Filters\TextFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class HoverText extends Field implements FilterableField
{
    use FieldFilterable;
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'hover-text';

    public function limit($limit)
    {
        return $this->withMeta(['limit' => $limit]);
    }

    public function href($href)
    {
        return $this->withMeta(['href' => $href]);
    }

    public function disableLink($value = true)
    {
        return $this->withMeta(['disableLink' => $value]);
    }

    protected function makeFilter(NovaRequest $request)
    {
        return new TextFilter($this);
    }
}
