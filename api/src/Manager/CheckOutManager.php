<?php

namespace App\Manager;

use App\Entity\CheckOut;
use App\Repository\CheckOutRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CheckOutManager
{
    private $checkOutRepository;

    public function __construct(CheckOutRepository $checkOutRepository)
    {
        $this->checkOutRepository = $checkOutRepository;
    }

    public function findAll()
    {
        return $this->checkOutRepository->findAll();
    }

    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return $this->checkOutRepository->find($id, $lockMode, $lockVersion);
    }

    public function findOneBy($criteria)
    {
        return $this->checkOutRepository->findOneBy($criteria);
    }

    //We test if all the conditions are fulfilled (Assert in Entity)
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

    //We test if all the conditions are fulfilled (Assert in Entity / User)
    public function validateMyPatchAssert(CheckOut $checkOut, ValidatorInterface $validator)
    {
        $validationErrors = $validator->validate($checkOut);
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
