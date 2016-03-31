<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/blue", name="blue")
     */
    public function blueAction(Request $request)
    {
//        $cmd = 'whoami';
//        $cmd = 'sudo /usr/local/bin/blink1-tool --list';
        $cmd = 'sudo /usr/local/bin/blink1-tool -m 1000 --blue';
//        $output = $returnVar = '';
        $execReturn = exec($cmd, $output, $returnVar);
        return $this->render('default/index.html.twig', [
//            'execReturn' => $execReturn,
//            'output' => var_export($output, true),
//            'returnVar' => var_export($returnVar, true),
        ]);
    }

    /**
     * @Route("/green", name="green")
     */
    public function greenAction(Request $request)
    {
        $cmd = 'sudo /usr/local/bin/blink1-tool -m 1000 --green';
        exec($cmd);
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/red", name="red")
     */
    public function redAction(Request $request)
    {
        $cmd = 'sudo /usr/local/bin/blink1-tool -m 1000 --red';
        exec($cmd);
        return $this->render('default/index.html.twig');
    }
}
