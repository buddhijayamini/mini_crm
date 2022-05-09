<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\EmployeeRequest;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Response;

class EmployeeController extends ApiController
{
    protected $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        $header = $request->header('Authorization',' ');

       if (!Str::startsWith($header, 'Bearer ')){
            return $this->responseUnauthorized();
        }

        return response()->json([
            'data' => $this->employeeRepository->getAllEmployees()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request1, EmployeeRequest $request): JsonResponse
    {
        $header = $request1->header('Authorization',' ');

       if (!Str::startsWith($header, 'Bearer ')){
            return $this->responseUnauthorized();
        }

    try{
            $validatedData = $request->validated();

        return response()->json(
            [
                'data' => $this->employeeRepository->createEmployee($validatedData)
            ],
            Response::HTTP_CREATED
        );
      }catch(Exception $e){
        return $this->errorResponse(500,'Error save resource--' .$e);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request): JsonResponse
    {
        $header = $request->header('Authorization',' ');

        if (!Str::startsWith($header, 'Bearer ')){
             return $this->responseUnauthorized();
         }

        try {
            $empId = $request->route('id');

            return response()->json([
                'data' => $this->employeeRepository->getEmployeeById($empId)
            ]);

        } catch (Exception $e) {
            return $this->errorResponse(500,'Error View resource--' .$e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeRequest  $request1): JsonResponse
    {
        $header = $request->header('Authorization',' ');

        if (!Str::startsWith($header, 'Bearer ')){
             return $this->responseUnauthorized();
         }

        try{
            $empId = $request->route('id');
            $empDetails = $request1->validated();

            return response()->json([
                'data' => $this->employeeRepository->updateEmployee($empId, $empDetails)
            ]);

        }catch(Exception $e){
            return $this->errorResponse(500,'Error update resource--' .$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {
        $header = $request->header('Authorization',' ');

        if (!Str::startsWith($header, 'Bearer ')){
             return $this->responseUnauthorized();
         }

        try{
            $empId = $request->route('id');

            $this->employeeRepository->deleteEmployee($empId);

            $response = self::successResponse('Deleted successfully.');
            return $response;

        }catch(Exception $e){
            return $this->errorResponse(500,'Error deleting resource--' .$e);
        }
    }
}
