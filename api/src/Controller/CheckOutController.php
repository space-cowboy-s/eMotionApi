<?php

namespace App\Controller;

use App\Entity\CheckOut;
use App\Manager\CheckOutManager;
use App\Repository\BookingRepository;
use App\Repository\CheckOutRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Booking;
use App\Manager\BookingManager;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Service\MailerService as Mailer;


class CheckOutController extends AbstractFOSRestController
{

    private $em;
    private $bookingManager;
    private $checkOutManager;

    public function __construct(EntityManagerInterface $em, BookingManager $bookingManager, CheckOutManager $checkOutManager)
    {
        $this->em = $em;
        $this->bookingManager = $bookingManager;
        $this->checkOutManager = $checkOutManager;
    }


    /**
     * @Rest\Get("/api/user/checkout/{id}")
     * @Rest\View(serializerGroups={"userlight", "car", "booking", "checkout"})
     * @Security(name="api_key")
     * @param $id
     * @SWG\Get(
     *      tags={"User/Checkout"},
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
     * @return View
     */
    public function getApiUserOneCheckOut($id)
    {
        $checkOut = $this->checkOutManager->find($id);
        return $this->view($checkOut);
    }

    /**
     * @Rest\Post("/api/user/checkout/add/{id}")
     * @Rest\View(serializerGroups={"userlight", "car", "booking", "checkout"})
     * @Security(name="api_key")
     * @SWG\Post(
     *      tags={"User/Checkout"},
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
     * @param $id
     * @param ConstraintViolationListInterface $validationErrors
     * @return View
     */
    public function postApiUserCheckout($id, ConstraintViolationListInterface $validationErrors)
    {
        $mail = new Mailer();

        $booking = $this->bookingManager->find($id);
        $date = date('d/m/Y');
        $checkOut = new checkOut;
        $checkOut->setBooking($booking);
        $checkOut->setPaymentValidator(1);
        $checkOut->setPaymentDate($date);
        $checkOut->setTotalPrice($booking->getTotalPriceHT());
        $this->em->persist($checkOut);
        $this->em->flush();
        $user = $booking->getUser();
        $mail->sendNewCheckoutMail($user->getEmail(), $user->getFirstname(), $checkOut->getId());

        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $this->checkOutManager->validateMyPostAssert($validationErrors);

        return $this->view($checkOut, 201);
    }


    /**
     * @Route("/checkout/pdf/{id}", name="check_out_pdf")
     * @param $id
     */
    public function createBill($id)
    {
        $checkout = $this->checkOutManager->find($id);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdf = new Dompdf($pdfOptions);
        $html = $this->render('check_out/facture.html.twig', [
                'checkout' => $checkout,
            ]
        );


        $pdf->loadHtml($html->getContent());

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $pdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $pdf->render();

        // Output the generated PDF to Browser (inline view)
        $pdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);

    }


}
