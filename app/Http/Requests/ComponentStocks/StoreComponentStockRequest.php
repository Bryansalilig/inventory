<?
namespace App\Http\Requests\ComponentStocks;

use Illuminate\Foundation\Http\FormRequest;

class StoreComponentStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'component_id'   => ['required', 'integer', 'exists:components,id'],
            'model_type'     => ['required', 'string', 'max:255'],
            'cost'           => ['required', 'numeric', 'min:0'],
            'quantity'       => ['required', 'integer', 'min:1'],
            'specification'  => ['required', 'string', 'max:255'],
            'supplier'       => ['required', 'string', 'max:255'],
            'purchase_date'  => ['required', 'date', 'before_or_equal:today'],
        ];        
    }
}
