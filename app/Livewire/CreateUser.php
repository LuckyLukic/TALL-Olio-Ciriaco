<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Address;
use Livewire\Component;

class CreateUser extends Component
{

    public $name, $surname, $email, $password, $repeatPassword, $phone;

    public $address, $city, $province, $postalCode, $country;

    protected $rules = [
        'name' => 'required|string',
        'surname' => 'required|string',
        'email' => 'required|email|unique:users',  //users plurale because is referred to the table
        'phone' => 'required|numeric',
        'password' => 'required|min:8',
        'repeatPassword' => 'required|same:password',
        'address' => 'required',
        'city' => 'required',
        'province' => 'required',
        'postalCode' => 'required',
        'country' => 'required'
    ];

    public function createUser()
    {
        $this->validate();

        $existingAddress = Address::where('address', $this->address)
            ->where('city', $this->city)
            ->where('province', $this->province)
            ->where('postal_code', $this->postalCode)
            ->where('country', $this->country)
            ->first();

        if (!$existingAddress) {
            $address = Address::create([

                'address' => $this->address,
                'city' => $this->city,
                'province' => $this->province,
                'postal_code' => $this->postalCode,
                'country' => $this->country
            ]);

        } else {

            $address = $existingAddress;

        }

        $newUser = User::create([
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => bcrypt($this->password),
            'address_id' => $address->id,
        ]);
    }


    public function render()
    {
        return view('livewire.create-user');
    }
}
