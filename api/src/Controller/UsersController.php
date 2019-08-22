<?php

namespace App\Controller;

use App\Manager\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UsersController extends AbstractFOSRestController
{
    private $em;
    private $userManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $em, UserManager $userManager, UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->em = $em;
        $this->userManager = $userManager;
        $this->passwordEncoder = $passwordEncoder;

    }

    /**
     * @Rest\Get("/api/user/profile")
     * @Rest\View(serializerGroups={"user", "booking"})
     * @Security(name="api_key")
     * @SWG\Get(
     *     tags={"User"},
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
    public function getApiUserProfile()
    {
        $user = $this->getUser();
        return $this->view($user, 200);
    }

    /**
     * @Rest\Patch("/api/user/profile")
     * @Rest\View(serializerGroups={"user", "booking"})
     * @Security(name="api_key")
     * @SWG\Patch(
     *     tags={"User"},
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
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return \FOS\RestBundle\View\View
     */
    public function patchApiUserProfile(Request $request, ValidatorInterface $validator)
    {
        $user = $this->getUser();

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

        //We test if all the conditions are fulfilled (Assert in Entity / Booking)
        //Return -> Throw a 400 Bad Request with all errors messages
        $this->userManager->validateMyPatchAssert($user, $validator);

        $this->em->persist($user);
        $this->em->flush();
        return $this->view($user, 200);
    }
}
