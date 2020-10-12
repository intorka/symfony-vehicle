<?php

namespace App\Controller;

use App\Entity\Parts;
use App\Entity\Vehicle;
use ContainerLOxRg0z\getTranslation_Loader_JsonService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Json;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        $vehicles = $this->getDoctrine()->getRepository(Vehicle::class)->findProducer();

        return $this->render('index.html.twig', array(

            'vehicles' => $vehicles

        ));
    }

    /**
     * @Route("/model/{producer}", name="model")
     * @param $producer
     * @return JsonResponse
     */
    public function model($producer)
    {
        $selection = "";

        $model = ['producer'=>$producer];

        $vehicleModels = $this->getDoctrine()->getRepository(Vehicle::class)->findModel($model);

        $selection .="<select id='modelSelect' class='custom-select d-block w-100'><option>Choose..</option>";
        foreach($vehicleModels as $vehicleModel){

            $selection .= "<option value='".$vehicleModel['model']."'>".$vehicleModel['model']."</option>";

        }
        $selection .= "</select>";

        return $this->json(['select'=> $selection]);
    }

    /**
     * @Route("/year", name="year")
     * @param Request $request
     * @return JsonResponse
     */
    public function year(Request $request)
    {
        $selection = "";

        $json = json_decode($request->getContent(), true);

        $vehicleEngines = $this->getDoctrine()->getRepository(Vehicle::class)->findYear($json);

        $selection .="<select id='yearSelect' class='custom-select d-block w-100'><option value='Choose'>Choose..</option>";

        foreach($vehicleEngines as $vehicleEngine){

            $selection .= "<option value='".$vehicleEngine->getId()."'>".$vehicleEngine->getYear()."</option>";

        }

        $selection .= "</select>";

        return $this->json(['select' => $selection]);
    }

    /**
     * @Route("/part", name="part")
     * @param Request $request
     * @return JsonResponse
     */
    public function getParts(Request $request){

        $json = json_decode($request->getContent(), true);

        $id = "%,".$json['vehicleId'].",%";

        $parts = $this->getDoctrine()->getRepository(Parts::class)->findParts($id);

        $lists = "<ol class='list-group'>";

        foreach ($parts as $part){
            $lists .= "<li class='list-group-item list-group-item-action'>".$part->getName()."</li>";
        }
        $lists .= "</ol>";

        return $this->json(['partLists' => $lists]);
    }

}
