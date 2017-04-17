<?php namespace Defr\FlatpickrFieldType\Validation;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Carbon\Carbon;

/**
 * Class ValidateDatetime
 *
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 *
 * @link   http://pyrocms.com/
 */
class ValidateDatetime
{

    /**
     * Handle the validation.
     *
     * @param  FormBuilder  $builder
     * @param  $attribute
     * @param  $value
     * @return bool
     */
    public function handle(FormBuilder $builder, $attribute, $value)
    {
        $fieldType = $builder->getFormFieldFromAttribute($attribute);

        try {
            new Carbon($value);
        }
        catch (\Exception $e)
        {
            return false;
        }

        return true;
    }
}
