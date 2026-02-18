<?
namespace App\Http\Requests\Cubicles;

use Illuminate\Foundation\Http\FormRequest;

class StoreCubicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
          'location' => 'required|integer',
          'name' => 'required|string',
          'last_cubicle' => 'required|string',
          'quantity' => 'required|integer|min:1|max:100',
        ];        
    }
}

