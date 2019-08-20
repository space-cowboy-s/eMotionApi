<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Manager\BookingManager;
use App\Repository\BookingRepository;
use App\Repository\CarRepository;
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
use App\Service\MailerService as Mailer;

class BookingController extends AbstractFOSRestController
{
    private $userRepository;
    private $em;
    private $bookingRepository;
    private $carRepository;

    public function __construct(UserRepository $userRepository, BookingRepository $bookingRepository, CarRepository $carRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
        $this->bookingRepository = $bookingRepository;
        $this->carRepository = $carRepository;
    }

    //All Bookings

    /**
     * @Rest\Get("/api/admin/bookings")
     * @Rest\View(serializerGroups={"userlight", "car", "booking"})
     * @Security(name="api_key")
     * @SWG\Get(
     *      tags={"Admin/Booking"},
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
     * @Rest\Get("/api/admin/bookings/{id}")
     * @Rest\View(serializerGroups={"userlight", "car", "booking"})
     * @Security(name="api_key")
     * @SWG\Get(
     *      tags={"Admin/Booking"},
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
     * @param Booking $booking
     * @return \FOS\RestBundle\View\View
     */
    public function getApiAdminOneBooking(Booking $booking)
    {
        return $this->view($booking, 200);
    }

    //Add booking by admin

    /**
     * @Rest\Post("/api/admin/bookings/add")
     * @ParamConverter("booking", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"userlight", "car", "booking"})
     * @Security(name="api_key")
     * @SWG\Post(
     *      tags={"Admin/Booking"},
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
     * @param Request $request
     * @param ConstraintViolationListInterface $validationErrors
     * @return \FOS\RestBundle\View\View
     */
    public function postApiAdminBooking(Booking $booking, BookingManager $bookingManager, Request $request, ConstraintViolationListInterface $validationErrors)
    {
        /*Select user by email*/
        $userSelect = $request->get('user');
        if (null !== $userSelect) {
            $user = $this->userRepository->findOneBy(array('email' => $userSelect));
        }else {
            $user = null;
        }

        /*Select car by brand and model*/
        $carSelect = $request->get('car');
        if (null !== $carSelect) {
            $car = $this->carRepository->findOneBy(array('brand' => $carSelect['brand'], 'model' => $carSelect['model']));
        }else {
            $car = null;
        }

        $startBooking = $request->get('startBooking');
        $endBooking = $request->get('endBooking');
        $totalPriceHT = $request->get('totalPriceHT');

        if (null !== $user) {
            $booking->setUser($user);
        }

        if (null !== $car) {
            $booking->setCar($car);
        }

        if (null !== $startBooking) {
            $booking->setStartBooking($startBooking);
        }

        if (null !== $endBooking) {
            $booking->setEndBooking($endBooking);
        }

        if (null !== $totalPriceHT) {
            $booking->setTotalPriceHT($totalPriceHT);
        }

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
     *      tags={"Admin/Booking"},
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
     * @param BookingManager $bookingManager
     * @param ValidatorInterface $validator
     * @param Request $request
     * @param $id
     * @return \FOS\RestBundle\View\View
     */
    public function patchApiAdminBooking(BookingManager $bookingManager, ValidatorInterface $validator, Request $request, $id)
    {
        $booking = $this->bookingRepository->find($id);

        /*Select car by brand and model*/
        $carSelect = $request->get('car');
        if (null !== $carSelect) {
            $car = $this->carRepository->findOneBy(array('brand' => $carSelect['brand'], 'model' => $carSelect['model']));
        }else {
            $car = null;
        }

        $startBooking = $request->get('startBooking');
        $endBooking = $request->get('endBooking');
        $totalPriceHT = $request->get('totalPriceHT');

        if (null !== $car) {
            $booking->setCar($car);
        }

        if (null !== $startBooking) {
            $booking->setStartBooking($startBooking);
        }

        if (null !== $endBooking) {
            $booking->setEndBooking($endBooking);
        }

        if (null !== $totalPriceHT) {
            $booking->setTotalPriceHT($totalPriceHT);
        }

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
     *      tags={"Admin/Booking"},
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
     * @param Booking $booking
     * @return \FOS\RestBundle\View\View
     */
    public function deleteApiBooking(Booking $booking)
    {
            $this->em->remove($booking);
            $this->em->flush();

        return $this->view('Booking are successfully removed !', 204);
    }

    //User booking car

    /**
     * @Rest\Post("/api/user/bookings/add")
     * @ParamConverter("booking", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"userlight", "car", "booking"})
     * @Security(name="api_key")
     * @SWG\Post(
     *      tags={"User/Booking"},
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
     * @param Request $request
     * @param ConstraintViolationListInterface $validationErrors
     * @return \FOS\RestBundle\View\View
     */
    public function postApiUserBooking(Booking $booking, BookingManager $bookingManager, Request $request, ConstraintViolationListInterface $validationErrors)
    {
        $user = $this->getUser();

        /*Select car by brand and model*/
        $carSelect = $request->get('car');
        if (null !== $carSelect) {
            $car = $this->carRepository->findOneBy(array('brand' => $carSelect['brand'], 'model' => $carSelect['model']));
        }else {
            $car = null;
        }

        $startBooking = $request->get('startBooking');
        $endBooking = $request->get('endBooking');
        $totalPriceHT = $request->get('totalPriceHT');

        if (null !== $user) {
            $booking->setUser($user);
        }

        if (null !== $car) {
            $booking->setCar($car);
        }

        if (null !== $startBooking) {
            $booking->setStartBooking($startBooking);
        }

        if (null !== $endBooking) {
            $booking->setEndBooking($endBooking);
        }

        if (null !== $totalPriceHT) {
            $booking->setTotalPriceHT($totalPriceHT);
        }

        //We test if all the conditions are fulfilled (Assert in Entity / Booking)
        //Return -> Throw a 400 Bad Request with all errors messages
        $bookingManager->validateMyPostAssert($validationErrors);

        $this->em->persist($booking);
        $this->em->flush();
        return $this->view($booking, 201);
    }
}
