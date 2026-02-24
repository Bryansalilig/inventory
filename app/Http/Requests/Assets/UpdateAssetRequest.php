<?
namespace App\Http\Requests\Assets;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'component_id' => [
              'required',
              'integer',
              'exists:components,id',
            ],
            'asset_tag' => [
                'required',
                'string',
            ],
            'selected_asset_tag' => [
                'required',
                'integer',
                'exists:assets,id',
            ],
        ];
    }
}
