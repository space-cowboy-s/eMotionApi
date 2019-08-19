<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use App\Repository\BookingRepository;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class AdminController extends AbstractFOSRestController
{
    private $userRepository;
    private $bookingRepository;
    private $em;

    public function __construct(UserRepository $userRepository, BookingRepository $bookingRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
        $this->em = $em;
    }

    /**
     * @Rest\Get("/api/admin/profile")
     * @Rest\View(serializerGroups={"user", "booking"})
     * @Security(name="api_key")
     * @SWG\Get(
     *      tags={"Admin"},
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
    public function getApiAdminProfile()
    {
        $user = $this->getUser();
        return $this->view($user, 200);
    }

    /**
     * @Rest\Get("/api/admin/users/profile/{id}")
     * @Rest\View(serializerGroups={"user", "booking"})
     * @Security(name="api_key"),
     * @SWG\Get(
     *      tags={"Admin"},
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
    public function getApiUserProfile(User $user)
    {
        return $this->view($user, 200);
    }

    //List of all users

    /**
     * @Rest\Get("/api/admin/users")
     * @Rest\View(serializerGroups={"user", "booking"})
     * @Security(name="api_key")
     * @SWG\Get(
     *      tags={"Admin"},
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

    /**
     * @Rest\Post("/api/admin/users/add")
     * @ParamConverter("user", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"user", "booking"})
     * @Security(name="api_key")
     * @SWG\Post(
     *      tags={"Admin"},
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
     *)
     */
    public function postApiAdmiAddUser(User $user, UserManager $userManager, ConstraintViolationListInterface $validationErrors)
    {
        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $userManager->validateMyPostAssert($validationErrors);

        $this->em->persist($user);
        $this->em->flush();
        return $this->view($user, 201);
    }

    /**
     * @Rest\Patch("/api/admin/profile")
     * @Rest\View(serializerGroups={"user", "booking"})
     * @Security(name="api_key")
     * @SWG\Patch(
     *      tags={"Admin"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
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
    public function patchApiAdminProfile(Request $request, UserManager $userManager, ValidatorInterface $validator)
    {
        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return false if not
        $user = $this->getUser();

        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $email = $request->get('email');
        $adress = $request->get('adress');
        $country = $request->get('country');
        //Find Booking with id
        $booking_id = $request->get('booking');
        if (null !== $booking_id) {
            $booking = $this->bookingRepository->find($booking_id);
        } else {
            $booking = null;
        }

        if (null !== $firstname) {
            $user->setFirstname($firstname);
        }

        if (null !== $lastname) {
            $user->setLastname($lastname);
        }

        if (null !== $email) {
            $user->setEmail($email);
        }

        if (null !== $adress) {
            $user->setAdress($adress);
        }

        if (null !== $country) {
            $user->setCountry($country);
        }

        if (null !== $booking) {
            $user->setBooking($booking);
        }

        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $userManager->validateMyPatchAssert($user, $validator);

        $this->em->persist($user);
        $this->em->flush();
        return $this->view($user, 200);
    }

    /**
     * @Rest\Patch("/api/admin/users/profile/{id}")
     * @Rest\View(serializerGroups={"user", "booking"})
     * @Security(name="api_key")
     * @SWG\Patch(
     *      tags={"Admin"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
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
    public function patchApiAdminUserProfile(User $user, Request $request, UserManager $userManager, ValidatorInterface $validator)
    {
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $email = $request->get('email');
        $adress = $request->get('adress');
        $country = $request->get('country');

        if (null !== $firstname) {
            $user->setFirstname($firstname);
        }

        if (null !== $lastname) {
            $user->setLastname($lastname);
        }

        if (null !== $email) {
            $user->setEmail($email);
        }

        if (null !== $adress) {
            $user->setAdress($adress);
        }

        if (null !== $country) {
            $user->setCountry($country);
        }

        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $userManager->validateMyPatchAssert($user, $validator);

        $this->em->persist($user);
        $this->em->flush();
        return $this->view($user, 200);
    }

    /**
     * @Rest\Delete("/api/admin/users/profile/remove/{id}")
     * @Rest\View(serializerGroups={"user", "booking"})
     * @Security(name="api_key")
     * @SWG\Delete(
     *      tags={"Admin"},
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
    public function deleteApiUser(User $user)
    {
        $this->em->remove($user);
        $this->em->flush();
        return $this->view($user, 204);
    }
}