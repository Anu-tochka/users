<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersController extends AbstractController
{
    #[Route('/', name: 'app_users')]
    public function index(): Response
    {
        return //new Response("hello!");
	$this->render('users/index.html.twig', [
			//'base.html.twig',[//
            'controller_name' => 'UsersController',
        ]);
    }
		
	#[Route('/import', name: 'app_import')]
	public function import(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response	
    {
		$i = 0;
		if ($request->request){
			$data = $request->get('rez');
				
			foreach ($data as $key => $value) {
				$users = new Users();
				$i++;
				$name = $value["name"];//.first;
				$email = $value["email"];//.first;
				$dob = $value["dob"];//.first; 
				$users->setFirstName($name["first"]);
				$users->setLastName($name["last"]);
				$users->setEmail($email);
				$users->setAge($dob["age"]);
				$entityManager->persist($users);
				$entityManager->flush();
				$entityManager->clear();
			}
		}
	//	$lastId = '';
    //   $pers = $doctrine->getRepository(Pers::class)->findByID($id);
		//$statuses = $doctrine->getRepository(Status::class)->findAll();
	//	if ($request->request){
			//$cont = $request->request;//->get('simple');
		/*	$users = new Day();
			$users->setDaynow($tDay);
			$users->setPers($doctrine->getRepository(Pers::class)->find($id));
			$users->setHours($request->request->get('hours'));
			$users->setKpi($request->request->get('kpi'));
			$users->setStatus($doctrine->getRepository(Status::class)->find($request->request->get('statusID')));
			if ($request->request->get('total')) $users->setTotal((float)$request->request->get('total'));
			$entity->persist($users);
			$entity->flush();
			$lastId = $users->getId(); // we can now get the Id
			$entity->clear();
		
		}	
    /*    $day = $doctrine->getRepository(Day::class)->find($dayID);
		$serializer = $this->get('serializer');
		$json = $serializer->serialize($day, 'json');
	return new Response($json);//	}*/
		return new Response("data $i");
	//	}
		//else return new Response('no data');
	/*	return $this->render('master/insert.html.twig', ['p' => $pers[0], 
				'now' => $targetDay, 
				'am' => $this->am, 
				'curmonthes' => $curmonthes,  
				'year' => $this->currentY,
				'statuses' => $statuses,
				'count' => $this->currentM,
				'hours' => $this->hours, 'kpi' => $this->kpi,
			]);
		*/
    }
		
}
