<?
namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
              'exists:employees,id',
            ],
            'employee_id' => [
                'required',
                'integer',
            ],
            'employee' => [
                'required',
                'integer',
            ],
            'new_employee_name' => [
                'required',
                'string',
            ],
            'new_employee_position' => [
                'required',
                'string',
            ],
        ];
    }
}
