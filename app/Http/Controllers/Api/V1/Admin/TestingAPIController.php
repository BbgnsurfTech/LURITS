<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTestingAPIRequest;
use App\Http\Requests\API\UpdateTestingAPIRequest;
use App\Models\Testing;
use App\Repositories\TestingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TestingController
 * @package App\Http\Controllers\API
 */

class TestingAPIController extends AppBaseController
{
    /** @var  TestingRepository */
    private $testingRepository;

    public function __construct(TestingRepository $testingRepo)
    {
        $this->testingRepository = $testingRepo;
    }

    /**
     * Display a listing of the Testing.
     * GET|HEAD /testings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $testings = $this->testingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($testings->toArray(), 'Testings retrieved successfully');
    }

    /**
     * Store a newly created Testing in storage.
     * POST /testings
     *
     * @param CreateTestingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTestingAPIRequest $request)
    {
        $input = $request->all();

        $testing = $this->testingRepository->create($input);

        return $this->sendResponse($testing->toArray(), 'Testing saved successfully');
    }

    /**
     * Display the specified Testing.
     * GET|HEAD /testings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Testing $testing */
        $testing = $this->testingRepository->find($id);

        if (empty($testing)) {
            return $this->sendError('Testing not found');
        }

        return $this->sendResponse($testing->toArray(), 'Testing retrieved successfully');
    }

    /**
     * Update the specified Testing in storage.
     * PUT/PATCH /testings/{id}
     *
     * @param int $id
     * @param UpdateTestingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTestingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Testing $testing */
        $testing = $this->testingRepository->find($id);

        if (empty($testing)) {
            return $this->sendError('Testing not found');
        }

        $testing = $this->testingRepository->update($input, $id);

        return $this->sendResponse($testing->toArray(), 'Testing updated successfully');
    }

    /**
     * Remove the specified Testing from storage.
     * DELETE /testings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Testing $testing */
        $testing = $this->testingRepository->find($id);

        if (empty($testing)) {
            return $this->sendError('Testing not found');
        }

        $testing->delete();

        return $this->sendSuccess('Testing deleted successfully');
    }
}
