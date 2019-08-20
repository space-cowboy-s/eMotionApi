<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use App\Service\MailerService;

class AnonymousController extends AbstractFOSRestController
{
    private $userRepository;
    private $em;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    //List of all users

    /**
     * @Rest\Get("/api/all-users")
     * @Rest\View(serializerGroups={"userlight", "booking"})
     * @SWG\Get(
     *      tags={"Anonymous"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
     *         ),
     *     @SWG\Response(
     *             response=204,
     *             description="No Content",
     *         ),
     *      @SWG\Response(
     *             response=400,
     *             description="Bad Request",
     *         ),
     *      @SWG\Response(
     *             response=403,
     *             description="Forbiden",
     *         ),
     *      @SWG\Response(
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     */
    public function getApiAllUsers()
    {
        $users = $this->userRepository->findAll();
        return $this->view($users, 200);
    }

    //One user

    /**
     * @Rest\Get("/api/profile/{id}")
     * @Rest\View(serializerGroups={"userlight", "booking"})
     * @SWG\Get(
     *     tags={"Anonymous"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
     *         ),
     *     @SWG\Response(
     *             response=204,
     *             description="No Content",
     *         ),
     *      @SWG\Response(
     *             response=400,
     *             description="Bad Request",
     *         ),
     *      @SWG\Response(
     *             response=403,
     *             description="Forbiden",
     *         ),
     *      @SWG\Response(
     *             response=404,
     *             description="Not Found",
     *         ),
     *     )
     */
    public function getApiUserProfile(User $user)
    {
        return $this->view($user, 200);
    }

    /**
     * @Rest\Post("/api/new/user")
     * @ParamConverter("user", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"user"})
     * @SWG\Post(
     *     tags={"Anonymous"},
     *      @SWG\Response(
     *             response=201,
     *             description="Created",
     *         ),
     *      @SWG\Response(
     *             response=400,
     *             description="Bad Request",
     *         ),
     *      @SWG\Response(
     *             response=403,
     *             description="Forbiden",
     *         ),
     *      @SWG\Response(
     *             response=404,
     *             description="Not Found",
     *         ),
     *     )
     * @param User $user
     * @param UserManager $userManager
     * @param ConstraintViolationListInterface $validationErrors
     * @return \FOS\RestBundle\View\View
     */
    public function postApiNewUser(User $user, UserManager $userManager, ConstraintViolationListInterface $validationErrors)
    {
        $mailer = new MailerService();

        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $userManager->validateMyPostAssert($validationErrors);

        $this->em->persist($user);
        $this->em->flush();
        $mailer->sendNewUserMail($user->getEmail(), $user->getFirstname());
        return $this->view($user, 201);
    }
}
