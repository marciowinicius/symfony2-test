<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Person;
use AppBundle\Entity\Person_phone;
use AppBundle\Entity\Shiporder;
use AppBundle\Entity\Shiporder_shipto;
use AppBundle\Entity\Shiporder_item;

class UploadController extends Controller
{
    /**
     * @Route("/upload/files")
     * @Method({"POST"})
    */
    public function upload(Request $request)
    {
        $aux = array();
        $invalid_files = array();

        for ($i = 0; $i < count($_FILES['files']['name']);  $i++)
        {
            if ($_FILES['files']['type'][$i] !== 'text/xml' && $_FILES['files']['type'][$i] !== 'application/xml')
            {
                $invalid_files[] = $_FILES['files']['name'][$i];
            }
            else
            {
                $aux[$_FILES['files']['name'][$i]] = [
                    'tmp_name' => $_FILES['files']['tmp_name'][$i],
                    'type' => $_FILES['files']['type'][$i]
                ];
            }
        }
        $files_array = [];

        foreach ($aux as $key => $value) 
        {
            $files_array['tmp_name'][] = $value['tmp_name'];
            $files_array['type'][] = $value['type'];
        }

        $uploadObj = $this->container->get('app.upload_service');    
        $items = $uploadObj->upload($files_array);

        foreach ($items as $items)
        {
            foreach ($items as $type => $item)
            {   
                switch ($type) {
                    case 'person':

                        $date = new \DateTime(gmdate('Y-m-d H:i:s'));

                        $person = new Person();
                        $person->setId($item->personid);
                        $person->setPersonName($item->personname);
                        $person->setCreated($date);
                        $person->setUpdated($date);

                        $entityManager = $this->getDoctrine()->getManager();

                        $personExists = $this->getDoctrine()
                            ->getRepository(Person::class)
                            ->find($item->personid);

                        if ($personExists) 
                        {
                            $person->setCreated($personExists->getCreated());
                            $entityManager->merge($person);
                        }
                        else
                        {
                            $entityManager->persist($person);
                        }

                        if (isset($item->phones) && isset($item->phones->phone) && count($item->phones->phone) > 0)
                        {
                            foreach ($item->phones->phone AS $key => $phone)
                            {
                                $phone = (array) $phone;
                                $phone = $phone[0];

                                $person_phone = new Person_phone();
                                $person_phone->setPerson($person);
                                $person_phone->setPhone($phone);
                                $person_phone->setCreated($date);
                                $person_phone->setUpdated($date);
                                
                                $entityManager = $this->getDoctrine()->getManager();

                                $phoneExists = $this->getDoctrine()
                                    ->getRepository(Person_phone::class)
                                    ->findOneBy(array('phone' => $phone));

                                if ($phoneExists) 
                                {
                                    $person_phone->setId(intval($phoneExists->getId()));
                                    $person_phone->setCreated($phoneExists->getCreated());
                                    $entityManager->merge($person_phone);
                                }
                                else 
                                {
                                    $entityManager->persist($person_phone);    
                                }
                            }
                        }

                        break;
                    
                    case 'shiporder':

                        $date = new \DateTime(gmdate('Y-m-d H:i:s'));

                        $shiporder = new Shiporder();

                        $person = $this->getDoctrine()
                        ->getRepository(Person::class)
                        ->findOneBy(array('id' => $item->orderperson));

                        $shiporder->setOrderPerson($person);
                        $shiporder->setOrderId($item->orderid);
                        $shiporder->setCreated($date);
                        $shiporder->setUpdated($date);
                        
                        $entityManager = $this->getDoctrine()->getManager();
                        
                        $shiporderExists = $this->getDoctrine()
                        ->getRepository(Shiporder::class)
                        ->findOneBy(array('orderid' => $item->orderid));

                        if ($shiporderExists) 
                        {
                            $shiporder->setId(intval($shiporderExists->getId()));
                            $shiporder->setCreated($shiporderExists->getCreated());
                            $entityManager->merge($shiporder);
                        }
                        else 
                        {
                            $entityManager->persist($shiporder);
                        }
                        
                        if (isset($item->shipto))
                        {
                            $shiporder_shipto = new Shiporder_shipto();
                            $shiporder_shipto->setCreated($date);
                            $shiporder_shipto->setUpdated($date);
                            $shiporder_shipto->setShiporder($shiporder);
                            $shiporder_shipto->setName($item->shipto->name);
                            $shiporder_shipto->setAddress($item->shipto->address);
                            $shiporder_shipto->setCity($item->shipto->city);
                            $shiporder_shipto->setCountry($item->shipto->country);

                            $entityManager = $this->getDoctrine()->getManager();

                            $shiporder_shiptoExists = $this->getDoctrine()
                                ->getRepository(Shiporder_shipto::class)
                                ->findOneBy(array(
                                    'name' => $item->shipto->name, 
                                    'address' => $item->shipto->address, 
                                    'city' => $item->shipto->city, 
                                    'country' => $item->shipto->country
                                ));

                            if ($shiporder_shiptoExists) 
                            {
                                $shiporder_shipto->setId(intval($shiporder_shiptoExists->getId()));
                                $shiporder_shipto->setCreated($shiporder_shiptoExists->getCreated());
                                $entityManager->merge($shiporder_shipto);
                            }
                            else
                            {
                                $entityManager->persist($shiporder_shipto);
                            }
                        }

                        if (isset($item->items))
                        {
                            foreach ($item->items as $key => $item)
                            {
                                $shiporder_item = new Shiporder_item();
                                $shiporder_item->setCreated($date);
                                $shiporder_item->setUpdated($date);
                                $shiporder_item->setShiporder($shiporder);
                                $shiporder_item->setTitle($item->item->title);
                                $shiporder_item->setNote($item->item->note);
                                $shiporder_item->setQuantity($item->item->quantity);
                                $shiporder_item->setPrice($item->item->price);
                                
                                $entityManager = $this->getDoctrine()->getManager();

                                $shiporder_itemExists = $this->getDoctrine()
                                    ->getRepository(Shiporder_item::class)
                                    ->findOneBy(array(
                                        'title' => $item->item->title, 
                                        'note' => $item->item->note, 
                                        'quantity' => $item->item->quantity, 
                                        'price' => $item->item->price
                                    ));

                                if ($shiporder_itemExists) 
                                {
                                    $shiporder_item->setId(intval($shiporder_itemExists->getId()));
                                    $shiporder_item->setCreated($shiporder_itemExists->getCreated());
                                    $entityManager->merge($shiporder_item);
                                }
                                else 
                                {
                                    $entityManager->persist($shiporder_item);    
                                }
                            }
                        }
                        break;

                    default:
                        break;
                }

                $entityManager->flush();
            }
        }

        if (count($invalid_files) > 0)
        {
            return $this->render('default/upload.html.twig', array(
                'type' => 'warning',
                'message' => 'Not possible to import this files: ' . implode(', ', $invalid_files)
            ));
        }

        return $this->render('default/upload.html.twig', array(
            'type' => 'success',
            'message' => 'Data imported.'
        ));
    }
}
