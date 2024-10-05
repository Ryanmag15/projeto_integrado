<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase; // Limpa o banco de dados após cada teste

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        // Cria um usuário com credenciais válidas
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password123'), // Senha em hash
        ]);

        // Realiza o login
        $response = $this->post('/auth/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Verifica se a resposta é bem-sucedida
        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token']); // Verifica se a resposta contém um token
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        // Tenta realizar o login com credenciais inválidas
        $response = $this->post('/auth/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        // Verifica se a resposta é não autorizada
        $response->assertStatus(401);
        $response->assertJson(['error' => 'Unauthorized']); // Mensagem de erro esperada
    }
}
