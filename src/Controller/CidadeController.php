<?php

namespace App\Controller;

use App\Entity\Cidade;
use App\Form\CidadeType;
use App\Repository\CidadeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cidade")
 */
class CidadeController extends Controller
{
    /**
     * @Route("/", name="cidade_index", methods="GET")
     */
    public function index(CidadeRepository $cidadeRepository): Response
    {
        return $this->render('cidade/index.html.twig', ['cidades' => $cidadeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="cidade_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $cidade = new Cidade();
        $form = $this->createForm(CidadeType::class, $cidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cidade);
            $em->flush();

            return $this->redirectToRoute('cidade_index');
        }

        return $this->render('cidade/new.html.twig', [
            'cidade' => $cidade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cidade_show", methods="GET")
     */
    public function show(Cidade $cidade): Response
    {
        return $this->render('cidade/show.html.twig', ['cidade' => $cidade]);
    }

    /**
     * @Route("/{id}/edit", name="cidade_edit", methods="GET|POST")
     */
    public function edit(Request $request, Cidade $cidade): Response
    {
        $form = $this->createForm(CidadeType::class, $cidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cidade_edit', ['id' => $cidade->getId()]);
        }

        return $this->render('cidade/edit.html.twig', [
            'cidade' => $cidade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cidade_delete", methods="DELETE")
     */
    public function delete(Request $request, Cidade $cidade): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cidade->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cidade);
            $em->flush();
        }

        return $this->redirectToRoute('cidade_index');
    }
}
