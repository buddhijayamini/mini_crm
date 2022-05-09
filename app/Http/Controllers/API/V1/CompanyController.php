<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use App\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Http\Requests\CompanyRequest;
use Exception;

class CompanyController extends ApiController
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
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
            'data' => $this->companyRepository->getAllCompanies()
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
    public function store(Request $request1, CompanyRequest $request): JsonResponse
    {
        $header = $request1->header('Authorization',' ');

       if (!Str::startsWith($header, 'Bearer ')){
            return $this->responseUnauthorized();
        }

    try{
            $validatedData = $request->validated();

        return response()->json(
            [
                'data' => $this->companyRepository->createCompany($validatedData)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request): JsonResponse
    {
        $header = $request->header('Authorization',' ');

        if (!Str::startsWith($header, 'Bearer ')){
             return $this->responseUnauthorized();
         }

        try {
            $compId = $request->route('id');

            return response()->json([
                'data' => $this->companyRepository->getCompanyById($compId)
            ]);

        } catch (Exception $e) {
            return $this->errorResponse(500,'Error View resource--' .$e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyRequest  $request1): JsonResponse
    {
        $header = $request->header('Authorization',' ');

        if (!Str::startsWith($header, 'Bearer ')){
             return $this->responseUnauthorized();
         }

     try{
        $compId = $request->route('id');
        $compDetails = $request1->validated();

        return response()->json([
            'data' => $this->companyRepository->updateCompany($compId, $compDetails)
        ]);
      }catch(Exception $e){
        return $this->errorResponse(500,'Error update resource--' .$e);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {
        $header = $request->header('Authorization',' ');

        if (!Str::startsWith($header, 'Bearer ')){
             return $this->responseUnauthorized();
         }

        try{
            $compId = $request->route('id');

            $result  = $this->companyRepository->deleteCompany($compId);

                $response = self::successResponse('Deleted successfully.');
                return $response;

        }catch(Exception $e){
            return $this->errorResponse(500,'Error deleting resource--' .$e);
        }
    }
}
