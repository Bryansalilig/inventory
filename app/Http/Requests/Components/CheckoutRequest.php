<?
namespace App\Http\Requests\Components;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $componentId = $this->input('component_id');

        // Fetch the component if the ID exists
        $component = null;
        if ($componentId) {
            $component = \App\Models\Component\Component::find($componentId);
        }

        return [
            'component_id' => [
                'required',
                'integer',
                'exists:components,id',
            ],
            'checkout_qty' => [
                'required',
                'integer',
                'min:1',
                // Only apply max/lte if component exists
                $component ? 'lte:' . $component->available_component : '',
            ],
            'employee_id' => [
                'required',
                'integer',
            ],
            'fullname' => [
                'required',
                'string',
                'max:255',
            ],
            'position' => [
                'required',
                'string',
                'max:100',
            ],
            'checkout_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before_or_equal:today',
            ],
        ];
    }

}
