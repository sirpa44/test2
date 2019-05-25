<?php declare(strict_types = 1);

namespace App\Controller;

use App\Service\RequestService;
use Symfony\Component\Routing\Annotation\Route;

class requestAPi
{
    /**
     * @var requestService
     */
    protected $request;

    public function __construct(RequestService $requestService)
    {
        $this->request = $requestService;
    }

    /**
     * select the requestService and return the results
     *
     * @Route("/", name="api.home")
     * @throws \Exception
     */
    public function requestHandling()
    {
        if (!key_exists('request', $_GET)) {
            throw new \Exception('request value doesn\'t exist');
        }
        if ($_GET['request'] == 'findOne') {
            $result = $this->request->findOne($_GET);
        } elseif ($_GET['request'] == 'findAll') {
            $result = $this->request->findAll();
        } elseif ($_GET['request'] == 'create') {
            $result = $this->request->create();
        } elseif ($_GET['request'] == 'update') {
            $result = $this->request->update();
        } else {
            throw new \Exception('request value doesn\'t exist');
        }
        return $result;
    }
}