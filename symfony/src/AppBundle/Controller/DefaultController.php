<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $blinks = $this->getParameter('blinks');
        for ($x = 0; $x < count($blinks); $x++) {
            $blinks[$x]['url'] = $this->generateUrl('blink', [
                'color' => $blinks[$x]['color'],
                'time' => $blinks[$x]['time']
            ]);
        }
        $sounds = $this->getParameter('sounds');
        return $this->render('default/index.html.twig', ['blinks' => $blinks, 'sounds' => $sounds]);
    }


    /**
     * @Route("/blink/{color}/{time}", name="blink")
     * @param Request $request
     * @param string $color
     * @param int $time
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function blinkAction(Request $request, $color, $time = 1000)
    {
        preg_match_all('/[0-9A-F]{2}/i', $color, $matches);
        $hexColor = $matches[0];
        $r = hexdec($hexColor[0]);
        $g = hexdec($hexColor[1]);
        $b = hexdec($hexColor[2]);
        $time = intval($time);

        $pathToBlinkTool = $this->container->getParameter('blinktoolpath');
        $cmd = "sudo $pathToBlinkTool -m $time --rgb=$r,$g,$b";

        $output = $returnVar = '';
        $execReturn = exec($cmd, $output, $returnVar);

        return new Response();
    }

    /**
     * @Route("/off/", name="off")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function offAction(Request $request)
    {
        $pathToBlinkTool = $this->getParameter('blinktoolpath');
        $cmd = "sudo $pathToBlinkTool --off";

        $output = $returnVar = '';
        $execReturn = exec($cmd, $output, $returnVar);

        return new Response();
    }

}
