<?
namespace App\Http\Requests\Assets;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
              'required',
              'integer',
              'exists:assets,id',
            ],
            'component_id' => [
              'required',
              'integer',
              'exists:components,id',
            ],
            'assign_asset_tag' => [
                'required',
                'string',
            ],
            'employee' => [
                'required',
                'integer',
            ],
            'employee_name' => [
                'required',
                'string',
            ],
            'employee_position' => [
                'required',
                'string',
            ],
        ];
    }
}
