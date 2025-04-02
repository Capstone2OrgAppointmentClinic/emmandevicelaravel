<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\ValidationException;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     * @return User
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        $validator = Validator::make($input, [
            'name' => ['regex:/^[\pL\s]+$/u', 'max:55','unique:users'],
            'phone' => ['regex:/^09[0-9]{9}$/', 'unique:users'],
            'email' => ['unique:users'],
            'student_id' => ['unique:users'],
            'password' => ['string', 'min:8', 'confirmed'],
        ], [
            'phone.regex' => 'The phone number must start with "09" followed by exactly 9 digits.',
            'phone.unique' => 'Phone number is already taken.',
            'email.unique' => 'Email is already taken.',
            'student_id.unique' => 'Student ID is already taken.',
        ]);

        if ($validator->fails()) {
            
            $errorFields = [];
            if ($validator->errors()->has('name')) {
                $errorFields[] = 'name';
            }
            if ($validator->errors()->has('phone')) {
                $errorFields[] = 'phone';
            }
            if ($validator->errors()->has('email')) {
                $errorFields[] = 'email';
            }
            if ($validator->errors()->has('student_id')) {
                $errorFields[] = 'student ID';
            }
            if ($validator->errors()->has('password')) {
                $errorFields[] = 'password';
            }

            if (count($errorFields) > 1) {
                $errorMessage = 'Invalid ' . implode(', ', $errorFields);
            } else {
                
                $errorMessage = $validator->errors()->first();
            }

            
            throw ValidationException::withMessages([
                'error' => $errorMessage,
            ]);
        }
        
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'student_id' => $input['student_id'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'education_level' => $input['education_level'],
            'course' => $input['course'],
            'year_level' => $input['year_level'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
