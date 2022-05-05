<?php

namespace App\Modules\Employee\Services;

use App\Helpers\TransformerResponse;
use App\Modules\Employee\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Modules\Employee\Services\Interfaces\EmployeeServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class EmployeeService implements EmployeeServiceInterface
{
    private $employeeyRepository;
    private $transformerResponse;

    public function __construct(
        TransformerResponse $transformerResponse,
        EmployeeRepositoryInterface $employeeyRepository
    )
    {
        $this->transformerResponse = $transformerResponse;
        $this->employeeyRepository = $employeeyRepository;
    }

    public function getAll()
    {
        try {
            $allEmployee = $this->employeeyRepository->getAll();
            return $this->transformerResponse->response(
                false,
                [
                    'allEmployee' => $allEmployee
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE
            );

        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    public function get($id)
    {
        try {
            $employee = $this->employeeyRepository->getById($id);
            if (empty($employee)) {
                return $this->transformerResponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE
                );
            }

            return $this->transformerResponse->response(
                false,
                [
                    'employee' => $employee
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    public function create($request)
    {
        try {
            $validated = $request->validated();
            $employee = $this->employeeyRepository->create($validated);
            return $this->transformerResponse->response(
                false,
                [
                    'employee' => $employee
                ],
                TransformerResponse::HTTP_CREATED,
                TransformerResponse::CREATE_SUCCESS_MESSAGE,

            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE
            );

        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    public function update($request, $id)
    {
        try {
            $validated = $request->validated();
            $employee = $this->employeeyRepository->updateByID($id);

            if (empty($employee)) {
                return $this->transformerResponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE
                );
            }

            $employee->name = $validated["name"];
            $employee->email = $validated["email"];
            $employee->position = $validated["position"];
            $employee->company_id = $validated["company_id"];
            $employee->save();

            return $this->transformerResponse->response(
                false,
                [
                    'employee' => $employee
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::UPDATE_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE
            );
        } catch (ModelNotFoundException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }

    public function delete($id)
    {
        try {
            $employee = $this->employeeyRepository->deleteById($id);
            if (empty($employee)) {
                return $this->transformerResponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE
                );
            }
            $employee->delete();
            return $this->transformerResponse->response(
                false,
                [
                    'employee' => $employee
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::DELETE_SUCCESS_MESSAGE
            );

        } catch (QueryException $exception) {

            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE
            );

        } catch (ModelNotFoundException $exception) {

            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_NOT_FOUND,
                TransformerResponse::NOT_FOUND_MESSAGE,
            );
        }
    }
}
