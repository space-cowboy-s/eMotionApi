<?php

namespace App\Manager;

use App\Entity\Booking;
use App\Entity\User;
use App\Repository\BookingRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;

class BookingManager
{
    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function findAll()
    {
        return $this->bookingRepository->findAll();
    }

    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return $this->bookingRepository->find($id, $lockMode, $lockVersion);
    }

    public function findOneBy($criteria)
    {
        return $this->bookingRepository->findOneBy($criteria);
    }

    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->bookingRepository->findBy($criteria, $orderBy, $limit, $offset);
    }

    //We test if all the conditions are fulfilled (Assert in Entity / Booking)
    public function validateMyPostAssert(ConstraintViolationListInterface $validationErrors)
    {
        $errors = array();
        if ($validationErrors->count() > 0) {
            /** @var ConstraintViolation $constraintViolation */
            foreach ($validationErrors as $constraintViolation) {
                // Returns the violation message. (Ex. This value should not be blank.)
                $message = $constraintViolation->getMessage();
                // Returns the property path from the root element to the violation. (Ex. lastname)
                $propertyPath = $constraintViolation->getPropertyPath();
                $errors[] = ['message' => $message, 'propertyPath' => $propertyPath];
            }
        }

        if (!empty($errors)) {
            // Throw a 400 Bad Request with all errors messages
            throw new BadRequestHttpException(\json_encode($errors));
        }
    }

    //We test if all the conditions are fulfilled (Assert in Entity / Booking)
    public function validateMyPatchAssert(Booking $Booking, ValidatorInterface $validator)
    {
        $validationErrors = $validator->validate($Booking);
        $errors = array();
        if ($validationErrors->count() > 0) {
            /** @var ConstraintViolation $constraintViolation */
            foreach ($validationErrors as $constraintViolation) {
                // Returns the violation message. (Ex. This value should not be blank.)
                $message = $constraintViolation->getMessage();
                // Returns the property path from the root element to the violation. (Ex. lastname)
                $propertyPath = $constraintViolation->getPropertyPath();
                $errors[] = ['message' => $message, 'propertyPath' => $propertyPath];
            }
        }

        if (!empty($errors)) {
            // Throw a 400 Bad Request with all errors messages
            throw new BadRequestHttpException(\json_encode($errors));
        }
    }
}