<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait EncryptModel
{
    /**
     * Method to decrypt the attributes
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (!isset($this->encryptable)) {
            throw new \Exception('The $encryptable property is not defined in the model');
        }

        $value = parent::__get($key);

        if (in_array($key, $this->encryptable) && !is_null($value)) {
            try {
                return Crypt::decryptString($value);
            } catch (\Throwable $e) {
                // If the value is not encrypted, return it as is
                return $value; //
            }
        }

        return $value;
    }

    /**
     * Method to encrypt the attributes
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        if (!isset($this->encryptable)) {
            throw new \Exception('The $encryptable property is not defined in the model');
        }

        if (in_array($key, $this->encryptable) && !is_null($value)) {
            $value = Crypt::encryptString($value);
        }

        parent::__set($key, $value);
    }
}
