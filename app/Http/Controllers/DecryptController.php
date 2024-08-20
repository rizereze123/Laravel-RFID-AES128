<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class DecryptController extends Controller
{
    // public function decryptCiphertext(Request $request)
    // {
    //     $ciphertextHex = $request->query('ciphertext_hex');
    //     $keyHex = $request->query('key'); // Key in hexadecimal
    //     $ivHex = $request->query('iv');   // IV in hexadecimal

    //     // Convert hex key and IV to binary
    //     $keyBinary = hex2bin($keyHex);
    //     $ivBinary = hex2bin($ivHex);

    //     try {
    //         // Convert hex ciphertext to binary
    //         $ciphertextBinary = hex2bin($ciphertextHex);

    //         // Decrypt using AES-128 in CBC mode with the provided key and IV
    //         $decryptedText = openssl_decrypt($ciphertextBinary, 'aes-128-cbc', $keyBinary, OPENSSL_RAW_DATA, $ivBinary);

    //         // Pass the decrypted text to the view
    //         return response()->json(['info' => $decryptedText]);
    //     } catch (\Exception $e) {
    //         Log::error('Decryption error: ' . $e->getMessage());
    //         return response()->json(['error' => 'An error occurred during decryption.']);
    //     }
    // }
    public function decryptCiphertext(Request $request)
    {
        $ciphertextHex = $request->query('ciphertext_hex');
        $keyHex = $request->query('key'); // Key in hexadecimal
        $ivHex = $request->query('iv');   // IV in hexadecimal

        // Convert hex key and IV to binary
        $keyBinary = hex2bin($keyHex);
        $ivBinary = hex2bin($ivHex);

        try {
            // Convert hex ciphertext to binary
            $ciphertextBinary = hex2bin($ciphertextHex);

            // Decrypt using AES-128 in CBC mode with the provided key and IV
            $decryptedText = openssl_decrypt($ciphertextBinary, 'aes-128-cbc', $keyBinary, OPENSSL_RAW_DATA, $ivBinary);

            // Check if the decryption was successful
            if ($decryptedText === false) {
                throw new \Exception('Decryption failed.');
            }

            // Trim last 1 characters from the decrypted text
            $trimmedText = substr($decryptedText, 0, -1);

            // Pass the trimmed decrypted text to the view
            return response()->json(['info' => $trimmedText]);
        } catch (\Exception $e) {
            Log::error('Decryption error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred during decryption.']);
        }
    }
}
