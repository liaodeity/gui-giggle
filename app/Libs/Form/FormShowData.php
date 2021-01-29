<?php
/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020/9/17
 */

namespace App\Libs\Form;


use App\Libs\Form\Contracts\BaseFrom;
use App\Models\SystemGui\Field;
use Illuminate\Database\Eloquent\Model;

class FormShowData extends BaseFrom
{
    public function getData ()
    {
        $table  = $this->model->getTable ();
        $fields = Field::where ('tab_name', $table)->get ();
        $labels = [];
        foreach ($fields as $field) {
            $labels[ $field->field_name ] = $field->title;
        }
        $data = [];
        foreach ($this->data['data'] as $key => $val) {
            $label = $labels[ $key ] ?? null;
            if (empty($label)) {
                continue;
            }
            $data[] = [
                'field' => $key,
                'label' => $label,
                'value' => $val
            ];
        }

        return $data;
    }
}
