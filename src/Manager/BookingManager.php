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
    private $BookingRepository;

    public function __construct(BookingRepository $BookingRepository)
    {
        $this->BookingRepository = $BookingRepository;
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