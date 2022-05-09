<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_has_an_employee()
    {
        $company = Company::factory()->create();
        $employee=Employee::factory(['company_id'=>$company->id,'first_name'=>'abc','last_name'=>'www','email'=>'abc@gmail.com'])->create();
        $this->assertInstanceOf('App\Models\Employee', $employee);
    }
}
