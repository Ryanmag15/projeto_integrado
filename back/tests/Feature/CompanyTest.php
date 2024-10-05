<?php

namespace Tests\Feature;

use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * Teste deve retornar todas as empresas
     */
    public function test_company_can_get_all_companies(): void
    {

        $response = $this->get('/company');

        $response->assertStatus(200);
    }

    /**
     * Teste deve retornar uma empresa específica
     */
    public function test_company_can_get_specific_company(): void
    {

        $response = $this->get('/company/1');

        $response->assertStatus(200);
    }

    /**
     * Teste deve criar uma empresa
     */
    // public function test_company_can_create_company(): void
    // {

    //     $response = $this->post('/company', [
    //         'name' => 'Empresa Teste',
    //         'corporate_reason' => 'Empresa Teste LTDA',
    //         'cnpj' => '12345678901234'
    //     ]);

    //     $response->assertStatus(200);
    // }
}
