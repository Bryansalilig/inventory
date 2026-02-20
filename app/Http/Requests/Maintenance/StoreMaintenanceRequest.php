<?
namespace App\Http\Requests\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:assets,id',
            'component_id' => 'required|integer|exists:components,id',
            'component_stock_id' => 'required|integer|exists:component_stocks,id',
            'employee_id'  => 'required|integer',
            'description'  => 'required|string|max:500',
            'asset_tag'    => 'required|string',
        ];        
    }
}

