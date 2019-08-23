<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use App\Service\MailerService;


class AnonymousController extends AbstractFOSRestController
{
    private $em;
    private $userManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $em, UserManager $userManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userManager = $userManager;
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/", name="home")
     */    public function home()
    {

        return $this->redirect('/api/doc');
    }

    //Connexion

    /**
     * @Rest\Post("/api/connexion")
     * @Rest\View(serializerGroups={"apiUser"})
     * @SWG\Post(
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
    public function getApiConnexion(Request $request)
    {
        $userSelect = $request->get('user');
        $userByEmail = null;

        if (null !== $userSelect) {
            $userByEmail = $this->userManager->findOneBy(array('email' => $userSelect['email']));
        }

        if ($userByEmail == null) {
            return $this->view($userByEmail, 404);
        }

        if ($this->passwordEncoder->isPasswordValid($userByEmail, $userSelect['password'])) {
            $user = $userByEmail;
        }
        else {
            $user = null;
            return $this->view($user, 404);
        }

        return $this->view($user, 200);
    }


    //List of all users

    /**
     * @Rest\Get("/api/all-users")
     * @Rest\View(serializerGroups={"user", "booking"})
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
        $users = $this->userManager->findAll();
        return $this->view($users, 200);
    }

    //One user

    /**
     * @Rest\Get("/api/profile/{id}")
     * @Rest\View(serializerGroups={"user", "booking"})
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
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param ConstraintViolationListInterface $validationErrors
     * @return View
     */
    public function postApiNewUser(User $user, Request $request, ConstraintViolationListInterface $validationErrors)
    {
        $mailer = new MailerService();
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $email = $request->get('email');
        $birthDate = $request->get('birthDate');
        $adress = $request->get('adress');
        $country = $request->get('country');
        $phone = $request->get('phone');
        $driverLicence = $request->get('driverLicence');
        $password = $request->get('password');

        $password_encode = $this->passwordEncoder->encodePassword($user, $password);


        if (null !== $firstname) {
            $user->setFirstname($firstname);
        }

        if (null !== $lastname) {
            $user->setLastname($lastname);
        }

        if (null !== $email) {
            $user->setEmail($email);
        }

        if (null !== $birthDate) {
            $user->setAdress($birthDate);
        }

        if (null !== $adress) {
            $user->setAdress($adress);
        }

        if (null !== $country) {
            $user->setCountry($country);
        }

        if (null !== $phone) {
            $user->setCountry($phone);
        }

        if (null !== $driverLicence) {
            $user->setCountry($driverLicence);
        }

        if (null !== $password_encode) {
            $user->setPassword($password_encode);
        }

        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $this->userManager->validateMyPostAssert($validationErrors);

        $this->em->persist($user);
        $this->em->flush();
        $mailer->sendNewUserMail($user->getEmail(), $user->getFirstname());
        return $this->view($user, 201);
    }
}
