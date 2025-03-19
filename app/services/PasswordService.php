<?php
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PasswordService
{
    public function random(int $length = 8): string
    {
        return Str::random(length: $length);
    }
    public function make(string $password): string
    {
        return Hash::make(value: $password);
    }
    public function check(string $value, string $hashedValue): bool
    {
        return Hash::check(value: $value,hashedValue: $hashedValue );
    }
    public function generate(int $length = 8): string
    {
        return $this->make(password: $this->random(length: $length));
    }
}