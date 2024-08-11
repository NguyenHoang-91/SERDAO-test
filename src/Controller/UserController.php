<?php

namespace App\Controller;

use App\Services\UserService;
use App\Entity\ErrorHandlerObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class UserController extends AbstractController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    #[Route('/user', name: 'user-index')]
    public function index(Request $request)
    {
        $users = $this->userService->getAllUsers();
        return $this->render('user.html.twig', [
            'obj' => $request->getMethod(),
            'users' => $users,
        ]);
    }

    #[Route('/user/add', name: 'add-user')]
    public function addUser(Request $request)
    {
        $errorObject = new ErrorHandlerObject();

        $firstName = $request->get("firstname");
        $lastName = $request->get("lastname");
        $address = $request->get("address");

        if (empty($firstName)) {
            $msg = "Missing First Name";
            $errorObject->setErrorMessage($msg);
            return $this->redirectToRoute('user-index' ,['error-message' => $errorObject->getErrorMessage()]);
        }
        if (empty($lastName)) {
            $msg = "Missing Last Name";
            $errorObject->setErrorMessage($msg);
            return $this->redirectToRoute('user-index' ,['error-message' => $errorObject->getErrorMessage()]);
        }
        if (empty($address)) {
            $msg = "Missing Email";
            $errorObject->setErrorMessage($msg);
            return $this->redirectToRoute('user-index' ,['error-message' => $errorObject->getErrorMessage()]);
        }

        $this->userService->addUser($firstName, $lastName, $address);
        return $this->redirectToRoute('user-index');
    }

    #[Route('/user/del', name: 'delete-user')]
    public function deleteUser(Request $request)
    {
        $errorObject = new ErrorHandlerObject();
        $id = $request->get("id");
        if(empty($id))
        {
            $msg = "Couldn't Found The User";
            $errorObject->setErrorMessage($msg);
            return $this->redirectToRoute('user-index' ,['error' => $errorObject->getErrorMessage()]);
        }
        $this->userService->deleteUser($id);
        return $this->redirectToRoute('user-index');
    }
}