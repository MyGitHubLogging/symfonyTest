<?php
/*test*/
namespace CG\SocialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CG\SocialBundle\Form\TopicType;
use CG\SocialBundle\Form\ResponseType;
use CG\SocialBundle\Entity\Topic;
use CG\SocialBundle\Entity\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class DefaultController extends Controller {

    public function indexAction() {

        return $this->render('CGSocialBundle:Default:index.html.twig');
    }

    public function testAction() {
        echo 'a';
    }

    public function fluxAction($page = 1) {
        $nbPerPage = $this->getParameter('nbPerPage');

        $repoTopic = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('CGSocialBundle:Topic');

        $listTopic = $repoTopic->getPaginatedTopics($page, $nbPerPage);

        $nbPages = ceil(count($listTopic) / $nbPerPage);
        return $this->render('CGSocialBundle:Default:listResponses.html.twig', array(
                    'listTopic' => $listTopic,
                    'page' => $page,
                    'nbPages' => $nbPages,
                    'fromRoute' => 'cg_flux',
        ));
    }

    public function historyAction($page = 1) {
        $nbPerPage = $this->getParameter('nbPerPage');
        $user = $this->getUser();
        $listTopic = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('CGSocialBundle:Topic')
                ->getPaginatedUserTopics($user, $page, $nbPerPage);
        $nbPages = ceil(count($listTopic) / $nbPerPage);
        return $this->render('CGSocialBundle:Default:listResponses.html.twig', array(
                    'listTopic' => $listTopic,
                    'page' => $page,
                    'nbPages' => $nbPages,
                    'fromRoute' => 'cg_history',
        ));
    }

    public function addTopicAction(Request $request, $fromRoute) {
        $topic = new Topic;

        $formBuilder = $this
                ->get('form.factory')
                ->createBuilder(TopicType::class, $topic);

        $form = $formBuilder->getForm();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $user = $this->getUser();
            $topic->setUser($user);
            $em = $this
                    ->getDoctrine()
                    ->getManager();
            $em->persist($topic);
            $em->flush();
            $request
                    ->getSession()
                    ->getFlashBag()
                    ->add('notice', 'Topic bien enregistré.');
            return $this->redirectToRoute($fromRoute);
        }
        return $this->render('CGSocialBundle:Default:formTopic.html.twig', array(
                    'form' => $form->createView(),
                    'fromRoute' => $fromRoute,
        ));
    }

    public function delTopicAction(Request $request, $idTopic, $fromRoute) {
        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $topic = $em->getRepository('CGSocialBundle:Topic')->find($idTopic);
            $user = $this->getUser();
            if ($topic->getUser()->getId() == $user->getId()) {
                $em->remove($topic);
                $em->flush();
                $request
                        ->getSession()
                        ->getFlashBag()
                        ->add('info', "Le topic a bien été supprimé.");
                return $this->redirectToRoute($fromRoute);
            }
            throw new UnauthorizedHttpException("Impossible de supprimer un Topic sans en être propriétaire");
        }
        return $this->render('CGSocialBundle:Default:delTopic.html.twig', array(
                    'form' => $form->createView(),
                    'idTopic' => $idTopic,
                    'fromRoute' => $fromRoute,
        ));
    }

    public function addResponseAction(Request $request, $idTopic, $fromRoute) {
        $response = new Response;
        $formBuilder = $this
                ->get('form.factory')
                ->createBuilder(ResponseType::class, $response);
        $form = $formBuilder->getForm();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this
                    ->getDoctrine()
                    ->getManager();
            $topic = $em
                    ->getRepository('CGSocialBundle:Topic')
                    ->find($idTopic);
            $response->setTopic($topic);
            $user = $this->getUser();
            $response->setUser($user);
            $em->persist($response);
            $em->flush();
            $request
                    ->getSession()
                    ->getFlashBag()
                    ->add('notice', 'Réponse bien enregistré.');
            return $this->redirectToRoute($fromRoute);
        }
        return $this->render('CGSocialBundle:Default:formResponse.html.twig', array(
                    'form' => $form->createView(),
                    'idTopic' => $idTopic,
                    'fromRoute' => $fromRoute,
        ));
    }

}
