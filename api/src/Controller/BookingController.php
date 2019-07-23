<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Manager\BookingManager;
use App\Repository\BookingRepository;
use App\Repository\UserRepository;

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class BookingController extends AbstractFOSRestController
{
    private $userRepository;
    private $em;
    private $bookingRepository;

    public function __construct(UserRepository $userRepository, BookingRepository $bookingRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
        $this->bookingRepository = $bookingRepository;
    }

    //All Bookings

    /**
     * @Rest\Get("/api/bookings")
     * @Rest\View(serializerGroups={"booking"})
     * @SWG\Get(
     *      tags={"Booking"},
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
    public function getApiAdminAllBooking()
    {
        $booking = $this->bookingRepository->findAll();
        return $this->view($booking, 200);
    }

    //One Bookings

    /**
     * @Rest\Get("/api/bookings/{id}")
     * @Rest\View(serializerGroups={"booking"})
     * @SWG\Get(
     *      tags={"Booking"},
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
    public function getApiAdminOneBooking($id)
    {
        $booking = $this->bookingRepository->find($id);
        return $this->view($booking, 200);
    }

    //Create One Bookings by admin

    /**
     * @Rest\Post("/api/admin/bookings/add")
     * @ParamConverter("booking", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"booking"})
     * @Security(name="api_key")
     * @SWG\Post(
     *      tags={"Booking/Admin"},
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
     * @param Booking $booking
     * @param BookingManager $bookingManager
     * @param ConstraintViolationListInterface $validationErrors
     * @return \FOS\RestBundle\View\View
     */
    public function postApiAdminBooking(Booking $booking, BookingManager $bookingManager, ConstraintViolationListInterface $validationErrors)
    {
        //We test if all the conditions are fulfilled (Assert in Entity / Booking)
        //Return -> Throw a 400 Bad Request with all errors messages
        $bookingManager->validateMyPostAssert($validationErrors);

        $this->em->persist($booking);
        $this->em->flush();
        return $this->view($booking, 201);
    }

    //Edit One Bookings by admin

    /**
     * @Rest\Patch("/api/admin/bookings/edit/{id}")
     * @Rest\View(serializerGroups={"booking"})
     * @Security(name="api_key")
     * @SWG\Patch(
     *      tags={"Booking/Admin"},
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
    public function patchApiAdminBooking(BookingManager $bookingManager, ValidatorInterface $validator, Request $request, $id)
    {
        $booking = $this->bookingRepository->find($id);

        /*TO DO*/

        //We test if all the conditions are fulfilled (Assert in Entity / Booking)
        //Return -> Throw a 400 Bad Request with all errors messages
        $bookingManager->validateMyPatchAssert($booking, $validator);

        $this->em->persist($booking);
        $this->em->flush();
        return $this->view($booking, 200);
    }

    //Delete one Booking by admin

    /**
     * @Rest\Delete("/api/admin/bookings/remove/{id}")
     * @Rest\View(serializerGroups={"booking"})
     * @Security(name="api_key")
     * @SWG\Delete(
     *      tags={"Booking/Admin"},
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
     *      @SWG\Response(
     *             response=500,
     *             description="Foreign Key Violation",
     *         ),
     *)
     */
    public function deleteApiBooking(Booking $booking)
    {
        try {
            $this->em->remove($booking);
            $this->em->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            return $this->view('ForeignKey Constraint Violation ! Can not remove a Booking with User !', 400);
        }

        return $this->view('Booking are successfully removed !', 204);
    }
}
