<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Repositories\Users\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Users\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected ValidatorFactory $validator;

    protected Hasher $hasher;

    protected UserRepositoryInterface $userRepository;

    protected string $redirectTo = RouteServiceProvider::HOME;

    public function __construct(ValidatorFactory $validator, Hasher $hasher, UserRepositoryInterface $userRepository)
    {
        $this->validator      = $validator;
        $this->hasher         = $hasher;
        $this->userRepository = $userRepository;

        $this->middleware('guest');
    }

    /**
     * @param array<string, mixed> $data
     * @return Validator
     */
    protected function validator(array $data): Validator
    {
        return $this->validator->make($data, [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);
    }

    /**
     * @param array<string, mixed> $data
     * @return User
     */
    protected function create(array $data): User
    {
        return $this->userRepository->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $this->hasher->make($data['password']),
        ]);
    }
}
