<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectNote;
use AppBundle\Form\ProjectFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller{

  /**
   * @Route("/project/new" )
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function createAction(Request $request){
    $project = new Project();
    $project->setProjectName('Dashboard Project');
    $project->setProjectDesc('Create a dashboard for projects to maintain a central location for projects');

    $note = new ProjectNote();
    $note->setUsername('AquaWeaver');
    $note->setUserAvatarFileName('ryan.jpeg');
    $note->setNote('I counted 8 legs... as they wrapped around me');
    $note->setCreatedAt(new \DateTime('-1 month'));
    $note->setProject($project);


    $form = $this->createForm(ProjectFormType::class);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
      $project = $form->getData();

      $em = $this->getDoctrine()->getManager();
      $em->persist($project);
      $em->flush();

      $this->addFlash('Hoorah!', 'Project has been created');

      return $this->redirectToRoute('app_dashboard_index');
    }
    return $this->render('dashboard/create.html.twig', array('projectForm' => $form->createView(),
    ));
  }

  /**
   *  @Route("/")
   * 
   */
  public function indexAction() {
    $em = $this->getDoctrine()->getManager();

    $projects = $em->getRepository('AppBundle:Project')
      ->findAll();

    return $this->render('dashboard/index.html.twig', array(
      'projects' => $projects ,
    ));
  }

  /**
   * @Route("/project/{projectName}", name="app_dashboard_show")
   */
  public function showAction($projectName){

    $em = $this->getDoctrine()->getManager();

    $project = $em->getRepository('AppBundle:Project')
      ->findOneBy(['projectName' => $projectName]);

    if(!$project){
      throw $this->createNotFoundException('Project not found');
    }

    $recentNotes = $em->getRepository('AppBundle:ProjectNote')
      ->findAllRecentNotesForGenus($project);

//    if (!$recentNotes){
//      throw $this->createNotFoundException('Notes not found');
//    }

    return $this->render('dashboard/show.html.twig', array(
      'project' => $project,
      'recentNoteCount' => count($recentNotes),
    ));
  }

  /**
   * @Route("/project/{name}/notes", name="project_show_notes")
   * @Method("GET")
   */
  public function getNotesAction(Project $project){

    $notes = [];

    foreach ($project->getNotes() as $note){
      $notes[] = [
        'id' => $note->getId(),
        'username' => $note->getUsername(),
        'avatarUri' =>'/images/'.$note->getUserAvatarFileName(),
        'note' => $note->getNote(),
        'date' => $note->getCreatedAt()->format('M d, Y')
      ];
    }

    $data = [ 'notes' => $notes];

    return new JsonResponse($data);
  }
}