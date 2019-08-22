<?php

namespace App\Controller;

use App\Entity\Car;
use App\Manager\CarManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CarController extends AbstractFOSRestController
{

    private $em;
    private $carManager;
    private $validator;

    /**
     * CarController constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em, CarManager $carManager, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->carManager = $carManager;
        $this->validator = $validator;
    }

    //Anonymous
    //Anonymous can see all cars

    /**
     * @Rest\Get("/api/cars")
     * @Rest\View(serializerGroups={"car"})
     * @SWG\Get(
     *     tags={"Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     */
    public function getApiCars()
    {
        $car = $this->carManager->findAll();

        return $this->view($car, 200);
    }


    //Anonymous can see one car

    /**
     * @Rest\Get("/api/car/{id}")
     * @Rest\View(serializerGroups={"car"})
     * @SWG\Get(
     *     tags={"Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param int $id
     * @return View
     */
    public function getApiCar(int $id)
    {
        $car = $this->carManager->find($id);
        return $this->view($car, 200);
    }


    //Admin
    //Admin all cars

    /**
     * @Rest\Get("/api/admin/cars")
     * @Rest\View(serializerGroups={"car"})
     * @Security(name="api_key")
     * @SWG\Get(
     *     tags={"Admin/Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     */
    public function getApiAdminCars()
    {
        $car = $this->carManager->findAll();

        return $this->json($car, 200);
    }

    //Admin One Car

    /**
     * @Rest\Get("/api/admin/car/{id}")
     * @Rest\View(serializerGroups={"car"})
     * @Security(name="api_key")
     * @SWG\Get(
     *     tags={"Admin/Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param int $id
     * @return View
     */
    public function getApiAdminCar(int $id)
    {
        $car = $this->carManager->find($id);
        return $this->view($car, 200);
    }

    //Admin car add

    /**
     * @Rest\Post("/api/admin/car/add")
     * @Rest\View(serializerGroups={"car"})
     * @ParamConverter("car", converter="fos_rest.request_body")
     * @Security(name="api_key")
     * @SWG\Post(
     *     tags={"Admin/Car"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
     *         ),
     *      @SWG\Response(
     *             response=201,
     *             description="Created",
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param Car $car
     * @param ConstraintViolationListInterface $validationErrors
     * @return View
     */
    public function postApiAdminCarListing(Car $car, ConstraintViolationListInterface $validationErrors)
    {
        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $this->carManager->validateMyPostAssert($validationErrors);

        $this->em->persist($car);
        $this->em->flush();
        return $this->view($car, 201);
    }

    //Admin car edit

    /**
     * @Rest\Patch("/api/admin/car/{id}")
     * @Rest\View(serializerGroups={"car"})
     * @Security(name="api_key")
     * @SWG\Patch(
     *     tags={"Admin/Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param Request $request
     * @param $id
     * @return View
     */
    public function patchApiAdminCar(Request $request, $id)
    {

        $car = $this->carManager->find($id);


        if (!empty($errors)) {
            throw new BadRequestHttpException(json_encode($errors));
        }
        if ($request->get("brand") !== null) {
            $car->setBrand($request->get("brand"));
        }
        if ($request->get("model") !== null) {
            $car->setModel($request->get("model"));
        }
        if ($request->get("serialNumber") !== null) {
            $car->setSerialNumber($request->get("serialNumber"));
        }
        if ($request->get("color") !== null) {
            $car->setColor($request->get("color"));
        }
        if ($request->get("numberplate") !== null) {
            $car->setNumberplate($request->get("numberplate"));
        }
        if ($request->get("numberKilometers") !== null) {
            $car->setNumberKilometers($request->get("numberKilometers"));
        }
        if ($request->get("purchaseDate") !== null) {
            $car->setPurchaseDate(($request->get("purchaseDate")));
        }
        if ($request->get("buyingPrice") !== null) {
            $car->setBuyingPrice($request->get("buyingPrice"));
        }
        if ($request->get("bail") !== null) {
            $car->setBail($request->get("bail"));
        }
        if ($request->get("type") !== null) {
            $car->setType($request->get("type"));
        }

        //We test if all the conditions are fulfilled (Assert in Entity / Booking)
        //Return -> Throw a 400 Bad Request with all errors messages
        $this->carManager->validateMyPatchAssert($car, $this->validator);

        $this->em->persist($car);
        $this->em->flush();
        return $this->view($car, 200);
    }


    //Admin car delete

    /**
     * @Rest\Delete("api/admin/car/{id}")
     * @Rest\View(serializerGroups={"car"})
     * @Security(name="api_key")
     * @SWG\Delete(
     *     tags={"Admin/Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param Car $car
     * @return View
     */
    public function deleteApiCar(Car $car)
    {
        $this->em->remove($car);
        $this->em->flush();

        return $this->view("Car deleted", 204);
    }


    //Owner
    //Owner all cars

    /**
     * @Rest\Get("/api/owner/cars")
     * @Rest\View(serializerGroups={"carlight"})
     * @Security(name="api_key")
     * @SWG\Get(
     *     tags={"Owner/Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     */
    public function getApiOwnerCars()
    {
        $car = $this->carManager->findAll();

        return $this->json($car, 200);
    }

    //Owner One Car

    /**
     * @Rest\Get("/api/owner/car/{id}")
     * @Rest\View(serializerGroups={"carlight"})
     * @Security(name="api_key")
     * @SWG\Get(
     *     tags={"Owner/Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param int $id
     * @return View
     */
    public function getApiOwnerCar(int $id)
    {
        $car = $this->carManager->find($id);
        return $this->view($car, 200);
    }

    //Owner car add car

    /**
     * @Rest\Post("/api/owner/car/add")
     * @Rest\View(serializerGroups={"carlight"})
     * @ParamConverter("car", converter="fos_rest.request_body")
     * @Security(name="api_key")
     * @SWG\Post(
     *     tags={"Owner/Car"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
     *         ),
     *      @SWG\Response(
     *             response=201,
     *             description="Created",
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param Car $car
     * @param ConstraintViolationListInterface $validationErrors
     * @return View
     */
    public function postApiOwnerCarListing(Car $car, ConstraintViolationListInterface $validationErrors)
    {
        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $this->carManager->validateMyPostAssert($validationErrors);

        $this->em->persist($car);
        $this->em->flush();
        return $this->view($car, 201);
    }

    //Owner car edit one car

    /**
     * @Rest\Patch("/api/owner/car/{id}")
     * @Rest\View(serializerGroups={"carlight"})
     * @Security(name="api_key")
     * @SWG\Patch(
     *     tags={"Owner/Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param Request $request
     * @param $id
     * @return View
     */
    public function patchApiOwnerCar(Request $request, $id)
    {

        $car = $this->carManager->find($id);


        if (!empty($errors)) {
            throw new BadRequestHttpException(json_encode($errors));
        }
        if ($request->get("brand") !== null) {
            $car->setBrand($request->get("brand"));
        }
        if ($request->get("model") !== null) {
            $car->setModel($request->get("model"));
        }
        if ($request->get("serialNumber") !== null) {
            $car->setSerialNumber($request->get("serialNumber"));
        }
        if ($request->get("color") !== null) {
            $car->setColor($request->get("color"));
        }
        if ($request->get("numberplate") !== null) {
            $car->setNumberplate($request->get("numberplate"));
        }
        if ($request->get("numberKilometers") !== null) {
            $car->setNumberKilometers($request->get("numberKilometers"));
        }
        if ($request->get("purchaseDate") !== null) {
            $car->setPurchaseDate(($request->get("purchaseDate")));
        }
        if ($request->get("buyingPrice") !== null) {
            $car->setBuyingPrice($request->get("buyingPrice"));
        }
        if ($request->get("bail") !== null) {
            $car->setBail($request->get("bail"));
        }
        if ($request->get("type") !== null) {
            $car->setType($request->get("type"));
        }

        //We test if all the conditions are fulfilled (Assert in Entity / Booking)
        //Return -> Throw a 400 Bad Request with all errors messages
        $this->carManager->validateMyPatchAssert($car, $this->validator);

        $this->em->persist($car);
        $this->em->flush();
        return $this->view($car, 200);
    }


    //Owner car delete

    /**
     * @Rest\Delete("api/owner/car/{id}")
     * @Rest\View(serializerGroups={"carlight"})
     * @Security(name="api_key")
     * @SWG\Delete(
     *     tags={"Owner/Car"},
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
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param Car $car
     * @return View
     */
    public function deleteApiOwnerCar(Car $car)
    {
        $this->em->remove($car);
        $this->em->flush();

        return $this->view("Car deleted", 204);
    }
}
