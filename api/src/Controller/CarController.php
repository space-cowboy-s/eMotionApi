<?php

namespace App\Controller;

use App\Entity\Car;
use App\Manager\CarManager;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;

class CarController extends AbstractFOSRestController
{

    private $carRepository;
    private $em;

    /**
     * CarController constructor.
     * @param $carRepository
     * @param $em
     */
    public function __construct(CarRepository $carRepository, EntityManagerInterface $em)
    {
        $this->carRepository = $carRepository;
        $this->em = $em;
    }

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
        $car = $this->carRepository->findAll();

        return $this->view($car, 200);
    }

    /**
     * @Rest\Post("/api/car/add")
     * @ParamConverter("car", converter="fos_rest.request_body")
     * @param Car $car
     * @param ConstraintViolationListInterface $validationErrors
     * @return \FOS\RestBundle\View\View
     */
    public function postApiCarListing(Car $car, ConstraintViolationListInterface $validationErrors)
    {
        $errors = array();
        if ($validationErrors->count() > 0) {
            foreach ($validationErrors as $constraintViolation ){
                $message = $constraintViolation->getMessage();
                $propertyPath = $constraintViolation->getPropertyPath();
                $errors[] = ['message' => $message, 'propertyPath' => $propertyPath];
            }
        }
        if (!empty($errors)) {
            throw new BadRequestHttpException(\json_encode($errors));
        }


        $this->em->persist($car);
        $this->em->flush();
        return $this->view($car);
    }
}
