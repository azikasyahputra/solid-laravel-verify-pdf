<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class VerifyDocumentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_verify_document_type_verified(): void
    {
        $registerUser = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $registerUser->assertStatus(200);

        $loginUser = $this->post('/api/login', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $loginUser->assertStatus(200);

        $token = $loginUser->json()['data'];

        $filename = 'verified_document.json';
        $tempfile = new File(public_path($filename));

        $files = new UploadedFile(
            $tempfile->getPathname(),
            $tempfile->getFilename(),
            $tempfile->getMimeType(),
            0,
            true
        );

        $verifyDocument = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/verify_document', [
            'document' => $files
        ]);

        $verifyDocument->assertStatus(200);
    }

    public function test_verify_document_type_invalid_recipient(): void
    {
        $registerUser = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $registerUser->assertStatus(200);

        $loginUser = $this->post('/api/login', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $loginUser->assertStatus(200);

        $token = $loginUser->json()['data'];

        $filename = 'invalid_recipient_document.json';
        $tempfile = new File(public_path($filename));

        $files = new UploadedFile(
            $tempfile->getPathname(),
            $tempfile->getFilename(),
            $tempfile->getMimeType(),
            0,
            true
        );

        $verifyDocument = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/verify_document', [
            'document' => $files
        ]);

        $verifyDocument->assertStatus(200);
    }

    public function test_verify_document_type_invalid_issuer(): void
    {
        $registerUser = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $registerUser->assertStatus(200);

        $loginUser = $this->post('/api/login', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $loginUser->assertStatus(200);

        $token = $loginUser->json()['data'];

        $filename = 'invalid_issuer_document.json';
        $tempfile = new File(public_path($filename));

        $files = new UploadedFile(
            $tempfile->getPathname(),
            $tempfile->getFilename(),
            $tempfile->getMimeType(),
            0,
            true
        );

        $verifyDocument = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/verify_document', [
            'document' => $files
        ]);

        $verifyDocument->assertStatus(200);
    }

    public function test_verify_document_type_invalid_signature(): void
    {
        $registerUser = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $registerUser->assertStatus(200);

        $loginUser = $this->post('/api/login', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $loginUser->assertStatus(200);

        $token = $loginUser->json()['data'];

        $filename = 'invalid_signature_document.json';
        $tempfile = new File(public_path($filename));

        $files = new UploadedFile(
            $tempfile->getPathname(),
            $tempfile->getFilename(),
            $tempfile->getMimeType(),
            0,
            true
        );

        $verifyDocument = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/verify_document', [
            'document' => $files
        ]);

        $verifyDocument->assertStatus(200);
    }
}
