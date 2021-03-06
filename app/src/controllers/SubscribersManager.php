<?php
namespace App\controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\model\dao\PlanDAO;
use App\model\dao\CustomerDAO;


final class SubscribersManager
{
    private $view;
    private $logger;

    public function __construct(Twig $view, LoggerInterface $logger, $db)
    {
        $this->db = $db;
        $this->view = $view;
        $this->logger = $logger;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        if(!isset($_SESSION['auth'])) {
            return $response->withRedirect('login');
        }
        $planDAO = new PlanDAO($this->db);
        $plans = $planDAO->getAllPlansToArray();
        $customerDAO = new CustomerDAO($this->db);
        $customers = $customerDAO->getAllCustomers();
        $this->view->render($response, 'subscribers_manager.twig',
                            ["customers" => $customers,
                             "plans" => $plans,
                             "category" => "Thuê bao",
                             "sub_category"=> "Danh sách thuê bao"]);
        return $response;
    }

    public function getCustomerDataBySubNum(Request $request, Response $response, $args)
    {
        $subNum = $request->getParam('subNum');
        $customerDAO = new CustomerDAO($this->db);
        $customer = $customerDAO->getCustomerBySubNum($subNum);
        $customerData = array("fullName" => $customer->getName(),
                              "address" => $customer->getAddress(),
                              "passport" => $customer->getPassport(),
                              "passportIssueDate" => $customer->getPassportIssueDate(),
                              "passportIssueAddress" => $customer->getPassportIssueLoc(),
                              "email" => $customer->getEmail(),
                              "contractCode" => $customer->getSubcribersNum(),
                              "phoneNumber" => $customer->getPhoneNum(),
                              "planId" => $customer->getPlanId(),
                              "registerDate" => $customer->getRegisterDate(),
                              "username" => $customer->getUsername());
        $response = $response->withJson($customerData, 201);
        return $response;
    }

    public function updateSubs(Request $request, Response $response, $args)
    {
        $subData = $request->getParam("subData");
        $customerDAO = new CustomerDAO($this->db);
        $planDAO = new PlanDAO($this->db);
        $planName = $planDAO->getPlanById($subData["planId"])->getPlanName();
        $subData["planName"] = $planName;
        $customerDAO->update($subData);
        $response = $response->withJson($subData, 201);
        return $response;
    }
}
