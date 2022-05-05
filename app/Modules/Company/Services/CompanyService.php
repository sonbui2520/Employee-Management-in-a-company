<?php

namespace App\Modules\Company\Services;

use App\Helpers\TransformerResponse;
use App\Modules\Company\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Modules\Company\Services\Interfaces\CompanyServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CompanyService implements CompanyServiceInterface
{
    private $companyRepository;
    private $transformerResponse;

    public function __construct(
        TransformerResponse $transformerResponse,
        CompanyRepositoryInterface $companyRepository
    )
    {
        $this->transformerResponse = $transformerResponse;
        $this->companyRepository = $companyRepository;
    }

    public function getAll()
    {
        try {
            $allCompany = $this->companyRepository->getAll();
            return $this->transformerResponse->response(
                false,
                [
                    'companies' => $allCompany
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
            $companie = $this->companyRepository->getById($id);
            if (empty($companie)) {
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
                    'companie' => $companie
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
            $companie = $this->companyRepository->create($validated);
            return $this->transformerResponse->response(
                false,
                [
                    'companie' => $companie
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
            $company = $this->companyRepository->updateByID($id);

            if (empty($company)) {
                return $this->transformerResponse->response(
                    true,
                    [],
                    TransformerResponse::HTTP_NOT_FOUND,
                    TransformerResponse::NOT_FOUND_MESSAGE
                );
            }

            $company->name = $validated["name"];
            $company->address = $validated["address"];
            $company->save();

            return $this->transformerResponse->response(
                false,
                [
                    'company' => $company
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
            $company = $this->companyRepository->deleteById($id);
            if (empty($company)) {
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
                    'company' => $company
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
