<?php

namespace App\Controller\admin;

use App\Entity\Playlist;
use App\Form\PlaylistType;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminPlaylistsController
 *
 * @author Antho
 */
class AdminPlaylistsController extends AbstractController
{
    public const PAGE_ADMIN_PLAYLISTS = 'admin/admin.playlists.html.twig';

    /**
     * @var PlaylistRepository
     */
    private $playlistRepository;

    /**
     * @var CategorieRepository
     */
    private $categorieRepository;

    /**
     * @var FormationRepository
     */
    private $formationRepository;

    public function __construct(
        PlaylistRepository $playlistRepository,
        CategorieRepository $categorieRepository,
        FormationRepository $formationRepository
    ) {
        $this->playlistRepository = $playlistRepository;
        $this->categorieRepository = $categorieRepository;
        $this->formationRepository = $formationRepository;
    }

    #[Route('/admin/playlists', name: 'admin.playlists')]
    public function index(): Response
    {
        $playlists = $this->playlistRepository->findAll();
        $categories = $this->categorieRepository->findAll();

        return $this->render(self::PAGE_ADMIN_PLAYLISTS, [
            'playlists' => $playlists,
            'categories' => $categories,
        ]);
    }

    #[Route('/admin/playlists/recherche/{champ}/{table}', name: 'admin.playlists.findallcontain')]
    public function findAllContain($champ, Request $request, $table = ''): Response
    {
        $valeur = $request->get('recherche');
        $playlists = $this->playlistRepository->findByContainValue($champ, $valeur, $table);
        $categories = $this->categorieRepository->findAll();

        return $this->render(self::PAGE_ADMIN_PLAYLISTS, [
            'playlists' => $playlists,
            'categories' => $categories,
            'valeur' => $valeur,
            'table' => $table,
        ]);
    }

    #[Route('/admin/playlists/tri/{champ}/{ordre}', name: 'admin.playlists.sort')]
    public function sort($champ, $ordre): Response
    {
        if ($champ === 'name') {
            $playlists = $this->playlistRepository->findAllOrderByName($ordre);
        } elseif ($champ === 'nbFormations') {
            $playlists = $this->playlistRepository->findAllOrderByNbFormations($ordre);
        } else {
            $playlists = $this->playlistRepository->findAll();
        }

        $categories = $this->categorieRepository->findAll();

        return $this->render(self::PAGE_ADMIN_PLAYLISTS, [
            'playlists' => $playlists,
            'categories' => $categories,
        ]);
    }

    #[Route('/admin/playlist/edit/{id}', name: 'admin.playlist.edit')]
    public function edit(int $id, Request $request): Response
    {
        $playlist = $this->playlistRepository->find($id);
        $formPlaylist = $this->createForm(PlaylistType::class, $playlist);
        $playlistFormations = $this->formationRepository->findAllForOnePlaylist($id);

        $formPlaylist->handleRequest($request);
        if ($formPlaylist->isSubmitted() && $formPlaylist->isValid()) {
            $this->playlistRepository->add($playlist);

            return $this->redirectToRoute('admin.playlists');
        }

        return $this->render('admin/admin.playlist.edit.html.twig', [
            'playlist' => $playlist,
            'formPlaylist' => $formPlaylist->createView(),
            'playlistformations' => $playlistFormations,
        ]);
    }

    #[Route('/admin/playlist/ajout', name: 'admin.playlist.ajout')]
    public function ajout(Request $request): Response
    {
        $playlist = new Playlist();
        $formPlaylist = $this->createForm(PlaylistType::class, $playlist);

        $formPlaylist->handleRequest($request);
        if ($formPlaylist->isSubmitted() && $formPlaylist->isValid()) {
            $this->playlistRepository->add($playlist);

            return $this->redirectToRoute('admin.playlists');
        }

        return $this->render('admin/admin.playlist.ajout.html.twig', [
            'playlist' => $playlist,
            'formPlaylist' => $formPlaylist->createView(),
        ]);
    }

    #[Route('/admin/playlist/suppr/{id}', name: 'admin.playlist.suppr')]
    public function suppr(int $id): Response
    {
        $playlist = $this->playlistRepository->find($id);
        $this->playlistRepository->remove($playlist);

        return $this->redirectToRoute('admin.playlists');
    }
}
