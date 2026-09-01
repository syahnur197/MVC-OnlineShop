<?php

namespace App\Controllers;

use App\Libraries\Auth;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Available in every controller and, through the view() calls below, in every view.
     */
    protected Auth $auth;

    /** Helpers every page needs: url for site_url(), form for form_open() and set_value(). */
    protected $helpers = ['url', 'form'];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->auth = service('auth');
    }

    /**
     * Turn a validation error list into the markup the existing views expect.
     *
     * @param array<string, string> $errors
     */
    protected function errorList(array $errors): string
    {
        return '<div class="alert alert-danger alert-dismissible">'
            . '<button type="button" class="close" data-dismiss="alert">&times;</button>'
            . '<ul class="mb-0">'
            . implode('', array_map(static fn ($e) => '<li>' . esc($e) . '</li>', $errors))
            . '</ul></div>';
    }
}
