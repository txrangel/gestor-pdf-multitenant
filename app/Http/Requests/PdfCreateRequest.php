<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class PdfCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required', // O campo "name" é obrigatório
                'string',   // Deve ser uma string
                'max:255',  // Máximo de 255 caracteres
            ],
            'file_path' => [
                'required', // O campo "file_path" é obrigatório
                'file',     // Deve ser um arquivo
                'mimetypes:application/pdf', // Aceita apenas arquivos PDF (validação mais precisa)
                //'max:10240', // Tamanho máximo de 10MB (10240 KB)
                Rule::unique('pdfs', 'file_path'), // Garante que o caminho do arquivo seja único na tabela "pdfs"
            ],
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'file_path.required' => 'O arquivo PDF é obrigatório.',
            'file_path.file' => 'O arquivo enviado deve ser um arquivo válido.',
            'file_path.mimetypes' => 'O arquivo deve ser do tipo PDF.',
            'file_path.max' => 'O arquivo não pode ser maior que 10MB.',
            'file_path.unique' => 'Já existe um arquivo com o mesmo nome.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    /*
    protected function prepareForValidation(): void
    {
        // Se um arquivo foi enviado, gera um caminho único para ele
        if ($this->hasFile('file_path')) {
            $file = $this->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nome único para o arquivo
            $filePath = 'pdfs/' . $fileName; // Caminho onde o arquivo será armazenado

            // Adiciona o caminho do arquivo aos dados validados
            $this->merge([
                'file_path' => $filePath,
            ]);
        }
    }
    */
}