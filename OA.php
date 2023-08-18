<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Services\TokenService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Candidate;
use App\Entity\User;
use App\Controller\HtAbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TokenController extends HtAbstractController
{
    /**
     * @Route("/api/generate/token/{id}", name="download_candidate", methods={"GET"})
     * @SWG\Get(
     *     path="/api/generate/token/{id}",
     *     summary="Generate token for CV download",
     *     description="Generate token for CV download",
     *     produces={"application/json"}
     * )
     * @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization")
     * @SWG\Parameter(name="action", in="query", required=true, type="string"),
     * @SWG\Response(response=200, description="Reponse",
     *      @SWG\Schema(type="object",
     *          @SWG\Property(property="token", type="string", example= "F0ZSI6MTYzMjk5MzM3NiwibmFtZSI6IkJvYiIsInVybCI6ImN2XC9wZGZcLyJ"),
     *      )
     * )
     * 
    */
    public function getToken(UserInterface $user, TokenService $tokenService, $id = null, Request $request) 
    {
        $action = $request->query->get('action');
        if (is_null($action)) {
            return $this->response(array('status' => false, 'message' => 'invalid request, action is null'),
            Response::HTTP_BAD_REQUEST);
        }

        if (!is_null($id) && false == $user instanceof Candidate) {
            $candidate = $this->getDoctrine()->getManager()->getRepository(Candidate::class)->find($id);
            
            return $this->response(array('token' => $tokenService->generateToken($candidate, $action)),
                Response::HTTP_OK);
        } 

        return $this->response(array('token' => $tokenService->generateToken($user, $action)),
            Response::HTTP_OK); 
    }

    /**
     * @Route("/api/token/test", name="token_test", methods={"GET"})
     * @SWG\Get(
     *     path="/api/token/test",
     *     summary="Generate token for test",
     *     description="Generate token for test",
     *     produces={"application/json"}
     * )
     * @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization")
     * @SWG\Parameter(name="action", in="query", required=true, type="string"),
     * @SWG\Response(response=200, description="Reponse",
     *      @SWG\Schema(type="object",
     *          @SWG\Property(property="token", type="string", example= "F0ZSI6MTYzMjk5MzM3NiwibmFtZSI6IkJvYiIsInVybCI6ImN2XC9wZGZcLyJ"),
     *      )
     * )
     * 
    */
    public function getTokenTest(UserInterface $user, TokenService $tokenService, Request $request) 
    {
        $action = $request->query->get('action');
        if (is_null($action)) {
            return $this->response(array('status' => false, 'message' => 'invalid request, action is null'),
            Response::HTTP_BAD_REQUEST);
        }

        $candidate = $this->getDoctrine()->getManager()->getRepository(User::class)->find($user);

        return $this->response(array('token' => $tokenService->generateToken($candidate, $action)),
            Response::HTTP_OK); 
    }
}
