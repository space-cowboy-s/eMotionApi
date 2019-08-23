<?php


namespace App\Controller;


use App\Entity\Preference;
use App\Manager\CarManager;
use App\Manager\PreferenceManager;
use App\Manager\UserManager;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PreferenceController extends AbstractFOSRestController
{
    private $em;
    private $userManager;
    private $preferenceManager;
    private $carManager;

    public function __construct(EntityManagerInterface $em, PreferenceManager $preferenceManager, UserManager $userManager, CarManager $carManager)
    {
        $this->em = $em;
        $this->userManager = $userManager;
        $this->preferenceManager = $preferenceManager;
        $this->carManager = $carManager;
    }

    //Add preference

    /**
     * @Rest\Post("/api/preference/add")
     * @ParamConverter("preference", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"preference", "userlight", "carlight"})
     * @SWG\Post(
     *     tags={"Preference"},
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
     * @param Request $request
     * @param Preference $preference
     * @param ConstraintViolationListInterface $validationErrors
     * @return View
     */
    public function postApiPreference(Request $request, Preference $preference, ConstraintViolationListInterface $validationErrors)
    {
        $user = $this->getUser();

        /*Select car by id*/
        $carSelect = $request->get('car');
        if (null !== $carSelect) {
            $car = $this->carManager->findOneBy(array('id' => $carSelect['id']));
        } else {
            $car = null;
            return $this->view('This car dont exist', 404);
        }

        $numberOfViews = $request->get('numberOfViews');

        //Test if preference alredy exist
        $preferenceTest = $this->preferenceManager->findOneBy(array('user' => $user, 'car' => $car));

        if ($preferenceTest !== null) {
            return $this->view('This preference already exist', 400);
        }

        if (!($this->isGranted('IS_AUTHENTICATED_FULLY'))) {

            return $this->view('Need authentification', 403);
        }

        if (null !== $user) {
            $preference->setUser($user);
        }

        if (null !== $car) {
            $preference->setCar($car);
        }

        if (null !== $numberOfViews) {
            $preference->setNumberOfViews($numberOfViews);
        }


        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $this->preferenceManager->validateMyPostAssert($validationErrors);

        $this->em->persist($preference);
        $this->em->flush();
        return $this->view($preference, 201);
    }

    //Admin
    //List of all preference

    /**
     * @Rest\Get("/api/admin/preferences")
     * @Rest\View(serializerGroups={"preference", "userlight", "carlight"})
     * @Security(name="api_key")
     * @SWG\Get(
     *      tags={"Admin/Preference"},
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
    public function getApiAdminAllPreferences()
    {
        $preferences = $this->preferenceManager->findAll();
        return $this->view($preferences, 200);
    }

    /**
     * @Rest\Get("/api/admin/preferences/{id}")
     * @Rest\View(serializerGroups={"preference", "userlight", "carlight"})
     * @Security(name="api_key"),
     * @SWG\Get(
     *      tags={"Admin/Preference"},
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
     * @param Preference $preference
     * @return View
     */
    public function getApiAdminOnePreference(Preference $preference)
    {
        return $this->view($preference, 200);
    }

    //Admin edit preference

    /**
     * @Rest\Patch("/api/admin/preference/add")
     * @Rest\View(serializerGroups={"preference", "userlight", "carlight"})
     * @Security(name="api_key")
     * @SWG\Patch(
     *     tags={"Admin/Preference"},
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
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return View
     */
    public function patchApiAdminPreference(Request $request, ValidatorInterface $validator)
    {
        /*Select user by email*/
        $userSelect = $request->get('user');

        if (null !== $userSelect) {
            $user = $this->userManager->findOneBy(array('email' => $userSelect['email']));
        } else {
            $user = null;
        }

        /*Select car by id*/
        $carSelect = $request->get('car');
        if (null !== $carSelect) {
            $car = $this->carManager->findOneBy(array('id' => $carSelect['id']));
        } else {
            $car = null;
        }

        //Test if preference exist
        $preference = $this->preferenceManager->findOneBy(array('user' => $user, 'car' => $car));

        if ($preference == null) {
            return $this->view('This preference dont exist', 400);
        }


        $numberOfViews = $request->get('numberOfViews');

        if (null !== $user) {
            $preference->setUser($user);
        }

        if (null !== $car) {
            $preference->setCar($car);
        }

        if (null !== $numberOfViews) {
            $preference->setNumberOfViews($numberOfViews);
        }


        //We test if all the conditions are fulfilled (Assert in Entity / Booking)
        //Return -> Throw a 400 Bad Request with all errors messages
        $this->preferenceManager->validateMyPatchAssert($preference, $validator);

        $this->em->persist($preference);
        $this->em->flush();
        return $this->view($preference, 201);
    }

    //Delete one Preference by admin

    /**
     * @Rest\Delete("/api/admin/preferences/remove/{id}")
     * @Rest\View(serializerGroups={"preference", "userlight", "carlight"})
     * @Security(name="api_key")
     * @SWG\Delete(
     *      tags={"Admin/Preference"},
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
     * @param Preference $preference
     * @return View
     */
    public function deleteApiAdminPreference(Preference $preference)
    {
        $this->em->remove($preference);
        $this->em->flush();

        return $this->view('Preference are successfully removed !', 204);
    }
}
