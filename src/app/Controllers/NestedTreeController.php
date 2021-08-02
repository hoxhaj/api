<?php

namespace Api\Controllers;

use Api\Core\Response\ApiResponse;
use Api\Core\Response\Response;
use Api\Exceptions\NestedTreeValidatorException;
use Api\Exceptions\RecordNotFoundException;
use Api\Factories\NodeRepositoryFactory;
use Api\Validators\NestedTreeValidator;

class NestedTreeController extends Controller
{
    /**
     * Logic of the /search endpoint
     *
     * @param array $request
     */
    public function search(array $request)
    {
        try {
            $validator = new NestedTreeValidator($request);
            $validator->validate();
            $validatedData = $validator->valid();

            $nodeRepository = NodeRepositoryFactory::build();
            $nodes = $nodeRepository->find($validatedData);

            if (!$nodes)
            {
                ApiResponse::withJson([], 404, Response::HTTP_404);
            }

            ApiResponse::withJson($nodes);
        }
        catch (NestedTreeValidatorException $e){
            ApiResponse::withJson([], $e->getCode(), $e->getMessage());
        }
        catch (RecordNotFoundException $e){
            ApiResponse::withJson([], 404, 'Invalid node id');
        }
        catch (\Exception $e)
        {
            ApiResponse::withJson([], 500, Response::HTTP_500);
        }
    }
}