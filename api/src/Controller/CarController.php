<?php

namespace App\Controller;

use App\Entity\Car;
use App\Manager\CarManager;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationListInterface;

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
     */
    public function getApiCars()
    {
        $car = $this->carRepository->findAll();

        return $this->view($car, 200);
    }

//    /**
//     * @Rest\Get('/api/car/add')
//     * @param Car $car
//     * @param CarManager $carManager
//     * @param ConstraintViolationListInterface $validationError
//     * @return \FOS\RestBundle\View\View
//     */
//    public function postApiCarListing(Car $car, CarManager $carManager, ConstraintViolationListInterface $validationError)
//    {
//        $carManager->validateMyPostAssert($validationError);
//
//        $this->em->persist($car);
//        $this->em->flush();
//        return $this->view($car, 200);
//    }
}
