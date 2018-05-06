<?php

namespace App\Controller;

use App\Entity\Endereco;
use App\Form\EnderecoType;
use App\Repository\EnderecoRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/endereco")
 */
class EnderecoController extends Controller
{
    /**
     * @Route("/", name="endereco_index", methods="GET")
     */
    public function index(EnderecoRepository $enderecoRepository): Response
    {
        return $this->render('endereco/index.html.twig', ['enderecos' => $enderecoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="endereco_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $endereco = new Endereco();
        $form = $this->createForm(EnderecoType::class, $endereco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($endereco);
            $em->flush();

            return $this->redirectToRoute('endereco_index');
        }

        return $this->render('endereco/new.html.twig', [
            'endereco' => $endereco,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="endereco_show", methods="GET")
     */
    public function show(Endereco $endereco): Response
    {
        return $this->render('endereco/show.html.twig', ['endereco' => $endereco]);
    }

    /**
     * @Route("/{id}/edit", name="endereco_edit", methods="GET|POST")
     */
    public function edit(Request $request, Endereco $endereco): Response
    {
        $form = $this->createForm(EnderecoType::class, $endereco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('endereco_edit', ['id' => $endereco->getId()]);
        }

        return $this->render('endereco/edit.html.twig', [
            'endereco' => $endereco,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="endereco_delete", methods="DELETE")
     */
    public function delete(Request $request, Endereco $endereco): Response
    {
        if ($this->isCsrfTokenValid('delete'.$endereco->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($endereco);
            $em->flush();
        }

        return $this->redirectToRoute('endereco_index');
    }

    /**
     * @Route("/find_by_cep/{cep}", name="find_by_cep", methods="GET")
     */
    public function find_by_cep(Int $cep)
    {
        try{
            $content = file_get_contents("https://viacep.com.br/ws/$cep/json/");

            $response = new Response($content);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
